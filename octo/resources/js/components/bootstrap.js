
/*
 |--------------------------------------------------------------------------
 | Laravel Spark Components
 |--------------------------------------------------------------------------
 |
 | Here we will load the Spark components which makes up the core client
 | application. This is also a convenient spot for you to load all of
 | your components that you write while building your applications.
 */

require('./../spark-components/bootstrap');

require('./home');

// require('./asset-management/assets/AssetmanagementAssetsCreate');

// ELEMENTS
Vue.component('octo-input', () => import('./elements/Input'));

// CONTAINERS
Vue.component('containers-containers-create', () => import('./containers/containers/ContainersContainersCreate'));
Vue.component('containers-inwards-create', () => import('./containers/inwards/ContainersInwardsCreate'));
Vue.component('containers-mlos-create', () => import('./containers/mlos/ContainersMlosCreate'));
Vue.component('containers-voyages-create', () => import('./containers/voyages/ContainersVoyagesCreate'));

// CONTRACTS
Vue.component('contracts-customers-create', () => import('./contracts/customers/ContractsCustomersCreate'));

// CRM
Vue.component('crm-customers-create', () => import('./crm/customers/CrmCustomersCreate'));

// FINANCE
Vue.component('finance-creditnotes-create', () => import('./finance/credit-notes/FinanceCreditNotesCreate'));

// GENERAL
Vue.component('attachment-create', () => import('./general/attachments/AttachmentCreate'));
Vue.component('attachment-index', () => import('./general/attachments/AttachmentIndex'));
Vue.component('attachment-widget', () => import('./general/attachments/AttachmentWidget'));

Vue.component('favorite-widget', () => import('./general/favorites/FavoriteWidget'));

Vue.component('reminder-widget', () => import('./general/reminders/ReminderWidget'));
Vue.component('reminder-create', () => import('./general/reminders/ReminderCreate'));
Vue.component('reminder-index', () => import('./general/reminders/ReminderIndex'));

// INTEGRATIONS
Vue.component('integrations-magento', () => import('./integrations/Magento'));

// LOGISTICS 3PL
Vue.component('logistics3p-invoices-create', () => import('./logistics3p/invoices/Logistics3pInvoicesCreate'));
Vue.component('logistics3p-invoices-preview-confirm', () => import('./logistics3p/invoices/Logistics3pInvoicesPreviewConfirm'));

Vue.component('logistics3p-transfers-create-location', () => import('./logistics3p/transfers/Logistics3pTransfersCreateLocation'));
Vue.component('logistics3p-transfers-create-location-add-stock', () => import('./logistics3p/transfers/Logistics3pTransfersCreateLocationAddStock'));

// SETTINGS
Vue.component('permissions-create', () => import('./settings/permissions/SettingsPermissionsCreate'));
Vue.component('permissions-edit', () => import('./settings/permissions/SettingsPermissionsEdit'));

// WAREHOUSE
Vue.component('warehouse-create', () => import('./warehouse/warehouse/WarehouseCreate'));

// VENDORS
Vue.component('vendors-create', () => import('./purchasing/vendors/VendorCreate'));
