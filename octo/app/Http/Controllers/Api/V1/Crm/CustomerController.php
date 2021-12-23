<?php

namespace App\Http\Controllers\Api\V1\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use AWS;
use Cache;
use Carbon\Carbon;
use DB;
use Storage;
use JWTAuth;

use App\Models\Crm\Customer;
use App\Models\Crm\Contact;
use App\Models\Category\Category;
use App\Models\User;

use Facades\App\Libraries\Crm\LeadSource;
use Facades\App\Libraries\System\Addresses;
use Facades\App\Libraries\System\Format;
use Facades\App\Libraries\System\CustomID;
use Facades\App\Libraries\System\Statuses;


class CustomerController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}


	public function index() {
		$customers = Customer::get();

		return $customers;
	}

	public function list(Request $request)
    {
        $customers = Customer::select('_id', 'name');

        if(isset($request->q) && !empty($request->q)) {
            $customers = $customers->where('name', 'like', '%' . $request->q . '%');
        }

        $customers = $customers->orderBy('name')->get();

        return $customers;
    }


	public function show(Request $request) {
		$customer = Customer::findOrFail($request->customer);

		return response()->json($customer, 200);
	}


	public function store(Request $request) {
		$customer = new Customer();
		$fillables = ['type', 'name', 'nameLegal', 'code', 'categoryID', 'mobile', 'fax', 'email', 'website', 'description', 'designation', 'countryID', 'leadSourceID', 'industryID', 'creditLimit', 'creditPeriod', 'geoLat', 'geoLon', 'taxNumberVAT', 'taxNumberSVAT'];
		foreach ($request->only($fillables) as $key => $value) {
			$customer->{$key} = !empty($value) ? $value : NULL;
		}

		$customer->customID = !empty($request->autoID) && $request->autoID ? CustomID::next(3) : ((!empty($request->customID) ? (is_numeric($request->customID) ? (int)$request->customID : $request->customID) : CustomID::next(3)));
		$customer->telephones = !empty($request->telephones) ? Format::extractArray($request->telephones) : array();
		$customer->customerSince = !empty($request->customerSince) ? date('Y-m-d', strtotime($request->customerSince)) : date('Y-m-d');
		$customer->statusID = !empty($request->statusID) ? $request->statusID : 1;
		$customer->unsubscribeMarketing = !empty($request->unsubscribeMarketing) && (boolean)$request->unsubscribeMarketing ? TRUE : FALSE;
		$customer->useTaxSVAT = !empty($request->useTaxSVAT) && $request->useTaxSVAT ? TRUE : FALSE;
		$customer->activity_at = Carbon::now();
		$customer->save();

		Addresses::create($request, $customer, 3, TRUE);

		return response()->json($customer, 200);
	}


	public function update(Request $request) {
		$customer = Customer::findOrFail($request->customer);

		$fillables = ['name', 'nameLegal', 'code', 'categoryID', 'mobile', 'fax', 'email', 'website', 'description', 'designation', 'industryID', 'countryID', 'leadSourceID', 'creditLimit', 'creditPeriod', 'taxNumberVAT', 'taxNumberSVAT'];
		foreach ($request->only($fillables) as $key => $value) {
			$customer->{$key} = $value;
		}

		$customer->telephones = !empty($request->telephones) ? Format::extractArray($request->telephones) : (isset($request->telephones) ? NULL : $customer->telephones);
		$customer->leadSourceID = !empty($request->leadSourceID) ? $request->leadSourceID : (isset($request->leadSourceID) ? NULL : $customer->leadSourceID);
		$customer->customerSince = !empty($request->customerSince) ? date('Y-m-d', strtotime($request->customerSince)) : $customer->customerSince;
		$customer->statusID = !empty($request->statusID) ? $request->statusID : $customer->statusID;
		$customer->useTaxSVAT = !empty($request->useTaxSVAT) && $request->useTaxSVAT ? TRUE : (isset($request->useTaxSVAT) && $request->useTaxSVAT ? NULL : FALSE);
		$customer->save();

		Addresses::update($request, $customer, 3, TRUE);

		return response()->json($customer, 200);
	}


	/**
	 * Customer support tickets
	 *
	 * Returns the support tickets that belongs to a provided customer
	 *
	 * @Post("/customer/support")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function support(Request $request) {
		$support = Customer::find($request->customerId)->support;

		return $support;
	}


	/**
	 * Customer notes
	 *
	 * Returns the notes that belongs to a provided customer
	 *
	 * @Post("/customer/notes")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function notes(Request $request) {
		$notes = Customer::find($request->customerId)->notes;

		return $notes;
	}


	/**
	 * Customer contacts
	 *
	 * Returns the contacts that are associated with the customer
	 *
	 * @Post("/customer/contacts")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function contacts(Request $request) {
		$contacts = Customer::find($request->customerId)->contacts;

		return $contacts;
	}


	/**
	 * Customer opportunities
	 *
	 * Returns the opportunities that belongs to a provided customer
	 *
	 * @Post("/customer/opportunities")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function opportunities(Request $request) {
		$opportunities = Customer::find($request->customerId)->opportunities;

		return $opportunities;
	}


	/**
	 * Customer quotations
	 *
	 * Returns the quotations that belongs to a provided customer
	 *
	 * @Post("/customer/quotations")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function quotations(Request $request) {
		$quotations = Customer::find($request->customerId)->quotations;

		return $quotations;
	}

	/**
	 * Customer invoices
	 *
	 * Returns the invoices that belongs to a provided customer
	 *
	 * @Post("/customer/invoices")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function invoices(Request $request) {
		$invoices = Customer::find($request->customerId)->invoices;

		return $invoices;
	}


	/**
	 * Customer sales orders
	 *
	 * Returns the sales orders that belongs to a provided customer
	 *
	 * @Post("/customer/sales-orders")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function salesorders(Request $request) {
		$salesOrders = Customer::find($request->customerId)->salesOrders;

		return $salesOrders;
	}


	/**
	 * Customer work orders
	 *
	 * Returns the work orders that belongs to a provided customer
	 *
	 * @Post("/customer/work-orders")
	 * @Parameters({
	 *      @Parameter("customerId", type="string", required=true, default=false, description="Whether the server should return the serve-able image URL or not."),
	 * })
	 * @Transaction({
	 *      @Request({"customerId": "546813a68bc6"}, headers={"Accept": "application/json", "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbG"}),
	 * })
	 */
	public function workorders(Request $request) {
		$workOrders = Customer::find($request->customerId)->workOrders;

		return $workOrders;
	}


	public function misc() {
		$response[ "distributionCenterAssociate" ] = array();
		$response[ "salesForceResourceAssociate" ] = array();


		//Associate Distribution Centers
		$dcassocs = DB::connection('mongodb')->collection('associations')->where('oid', $aoid)->where('type', 3)->where('typeid', $customer_id)->where('atype', 8)->get();
		$dcassocs = fxArrayToObject($dcassocs);

		foreach ( $dcassocs as $dcassocsInfo ) {

			$tmpDcAssocs = array();
			$tmpDcAssocs['id'] = !empty($dcassocsInfo->atypeid) ? $dcassocsInfo->atypeid : NULL;
			$tmpDcAssocs['distributor'] = !empty($dcassocsInfo->atypeid) ?  getDistributionCenterById((string)$dcassocsInfo->atypeid) : NULL;

			array_push( $response[ "distributionCenterAssociate" ], $tmpDcAssocs );
		}


		//Associate Sales Force Resources
		$salesForceResourceAssocs = DB::connection('mongodb')->collection('associations')->where('oid', $aoid)->where('type', 3)->where('typeid', $customer_id)->where('atype', 10)->get();
		$salesForceResourceAssocs = fxArrayToObject($salesForceResourceAssocs);

		foreach ( $salesForceResourceAssocs as $salesForceResourceAssocsInfo ) {

			$tmpSalesForceResourceAssocs = array();
			$tmpSalesForceResourceAssocs['id'] = !empty($salesForceResourceAssocsInfo->atypeid) ? $salesForceResourceAssocsInfo->atypeid : NULL;
			$tmpSalesForceResourceAssocs['distributor'] = !empty($salesForceResourceAssocsInfo->atypeid) ?  getSalesForceResourceById((string)$salesForceResourceAssocsInfo->atypeid) : NULL;

			array_push( $response[ "salesForceResourceAssociate" ], $tmpSalesForceResourceAssocs );
		}


		return response()->json($response, 200);
	}


	/** Create user account **/
	public function createUser(Request $request){
		$password = "Abc@1234";

		$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => bcrypt($password),
		]);

		return response()->json($user, 200);
	}
}
