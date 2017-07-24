<?php

namespace app\models;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "res_users".
 *
 * @property integer $id
 * @property boolean $active
 * @property string $login
 * @property string $password
 * @property integer $company_id
 * @property integer $partner_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $menu_id
 * @property string $login_date
 * @property string $signature
 * @property integer $action_id
 * @property integer $alias_id
 * @property boolean $share
 * @property string $initial
 * @property integer $kelompok_id
 *
 * @property AccountAccount[] $accountAccounts
 * @property AccountAccount[] $accountAccounts0
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property AccountAccountTemplate[] $accountAccountTemplates0
 * @property AccountAccountType[] $accountAccountTypes
 * @property AccountAccountType[] $accountAccountTypes0
 * @property AccountAddtmplWizard[] $accountAddtmplWizards
 * @property AccountAddtmplWizard[] $accountAddtmplWizards0
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances0
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts0
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts1
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts2
 * @property AccountAnalyticBalance[] $accountAnalyticBalances
 * @property AccountAnalyticBalance[] $accountAnalyticBalances0
 * @property AccountAnalyticChart[] $accountAnalyticCharts
 * @property AccountAnalyticChart[] $accountAnalyticCharts0
 * @property AccountAnalyticCostLedger[] $accountAnalyticCostLedgers
 * @property AccountAnalyticCostLedger[] $accountAnalyticCostLedgers0
 * @property AccountAnalyticCostLedgerJournalReport[] $accountAnalyticCostLedgerJournalReports
 * @property AccountAnalyticCostLedgerJournalReport[] $accountAnalyticCostLedgerJournalReports0
 * @property AccountAnalyticInvertedBalance[] $accountAnalyticInvertedBalances
 * @property AccountAnalyticInvertedBalance[] $accountAnalyticInvertedBalances0
 * @property AccountAnalyticJournal[] $accountAnalyticJournals
 * @property AccountAnalyticJournal[] $accountAnalyticJournals0
 * @property AccountAnalyticJournalReport[] $accountAnalyticJournalReports
 * @property AccountAnalyticJournalReport[] $accountAnalyticJournalReports0
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountAnalyticLine[] $accountAnalyticLines0
 * @property AccountAnalyticLine[] $accountAnalyticLines1
 * @property AccountAssetAsset[] $accountAssetAssets
 * @property AccountAssetAsset[] $accountAssetAssets0
 * @property AccountAssetCategory[] $accountAssetCategories
 * @property AccountAssetCategory[] $accountAssetCategories0
 * @property AccountAssetDepreciationLine[] $accountAssetDepreciationLines
 * @property AccountAssetDepreciationLine[] $accountAssetDepreciationLines0
 * @property AccountAssetHistory[] $accountAssetHistories
 * @property AccountAssetHistory[] $accountAssetHistories0
 * @property AccountAssetHistory[] $accountAssetHistories1
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles0
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountBalanceReport[] $accountBalanceReports0
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards0
 * @property AccountBankStatement[] $accountBankStatements
 * @property AccountBankStatement[] $accountBankStatements0
 * @property AccountBankStatement[] $accountBankStatements1
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountBankStatementLine[] $accountBankStatementLines0
 * @property AccountCashboxLine[] $accountCashboxLines
 * @property AccountCashboxLine[] $accountCashboxLines0
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountCentralJournal[] $accountCentralJournals0
 * @property AccountChangeCurrency[] $accountChangeCurrencies
 * @property AccountChangeCurrency[] $accountChangeCurrencies0
 * @property AccountChart[] $accountCharts
 * @property AccountChart[] $accountCharts0
 * @property AccountChartTemplate[] $accountChartTemplates
 * @property AccountChartTemplate[] $accountChartTemplates0
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property AccountCommonAccountReport[] $accountCommonAccountReports0
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonJournalReport[] $accountCommonJournalReports0
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports0
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountCommonReport[] $accountCommonReports0
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property AccountConfigSettings[] $accountConfigSettings0
 * @property AccountFinancialReport[] $accountFinancialReports
 * @property AccountFinancialReport[] $accountFinancialReports0
 * @property AccountFiscalPosition[] $accountFiscalPositions
 * @property AccountFiscalPosition[] $accountFiscalPositions0
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts0
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates0
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes0
 * @property AccountFiscalPositionTaxGlobal[] $accountFiscalPositionTaxGlobals
 * @property AccountFiscalPositionTaxGlobal[] $accountFiscalPositionTaxGlobals0
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates0
 * @property AccountFiscalPositionTemplate[] $accountFiscalPositionTemplates
 * @property AccountFiscalPositionTemplate[] $accountFiscalPositionTemplates0
 * @property AccountFiscalyear[] $accountFiscalyears
 * @property AccountFiscalyear[] $accountFiscalyears0
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses0
 * @property AccountFiscalyearCloseState[] $accountFiscalyearCloseStates
 * @property AccountFiscalyearCloseState[] $accountFiscalyearCloseStates0
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountGeneralJournal[] $accountGeneralJournals0
 * @property AccountInstaller[] $accountInstallers
 * @property AccountInstaller[] $accountInstallers0
 * @property AccountInvoice[] $accountInvoices
 * @property AccountInvoice[] $accountInvoices0
 * @property AccountInvoice[] $accountInvoices1
 * @property AccountInvoice[] $accountInvoices2
 * @property AccountInvoiceCancel[] $accountInvoiceCancels
 * @property AccountInvoiceCancel[] $accountInvoiceCancels0
 * @property AccountInvoiceConfirm[] $accountInvoiceConfirms
 * @property AccountInvoiceConfirm[] $accountInvoiceConfirms0
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property AccountInvoiceLine[] $accountInvoiceLines0
 * @property AccountInvoiceLineTaxAmount[] $accountInvoiceLineTaxAmounts
 * @property AccountInvoiceLineTaxAmount[] $accountInvoiceLineTaxAmounts0
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds0
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountInvoiceTax[] $accountInvoiceTaxes0
 * @property AccountJournal[] $accountJournals
 * @property AccountJournal[] $accountJournals0
 * @property AccountJournal[] $accountJournals1
 * @property AccountJournalCashboxLine[] $accountJournalCashboxLines
 * @property AccountJournalCashboxLine[] $accountJournalCashboxLines0
 * @property AccountJournalPeriod[] $accountJournalPeriods
 * @property AccountJournalPeriod[] $accountJournalPeriods0
 * @property AccountJournalSelect[] $accountJournalSelects
 * @property AccountJournalSelect[] $accountJournalSelects0
 * @property AccountModel[] $accountModels
 * @property AccountModel[] $accountModels0
 * @property AccountModelLine[] $accountModelLines
 * @property AccountModelLine[] $accountModelLines0
 * @property AccountMove[] $accountMoves
 * @property AccountMove[] $accountMoves0
 * @property AccountMoveBankReconcile[] $accountMoveBankReconciles
 * @property AccountMoveBankReconcile[] $accountMoveBankReconciles0
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountMoveLine[] $accountMoveLines0
 * @property AccountMoveLineReconcile[] $accountMoveLineReconciles
 * @property AccountMoveLineReconcile[] $accountMoveLineReconciles0
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects0
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs0
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects0
 * @property AccountMoveReconcile[] $accountMoveReconciles
 * @property AccountMoveReconcile[] $accountMoveReconciles0
 * @property AccountOpenClosedFiscalyear[] $accountOpenClosedFiscalyears
 * @property AccountOpenClosedFiscalyear[] $accountOpenClosedFiscalyears0
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountPartnerBalance[] $accountPartnerBalances0
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountPartnerLedger[] $accountPartnerLedgers0
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses0
 * @property AccountPaymentTerm[] $accountPaymentTerms
 * @property AccountPaymentTerm[] $accountPaymentTerms0
 * @property AccountPaymentTermLine[] $accountPaymentTermLines
 * @property AccountPaymentTermLine[] $accountPaymentTermLines0
 * @property AccountPeriod[] $accountPeriods
 * @property AccountPeriod[] $accountPeriods0
 * @property AccountPeriodClose[] $accountPeriodCloses
 * @property AccountPeriodClose[] $accountPeriodCloses0
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountPrintJournal[] $accountPrintJournals0
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers0
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears0
 * @property AccountStateOpen[] $accountStateOpens
 * @property AccountStateOpen[] $accountStateOpens0
 * @property AccountStatementFromInvoiceLines[] $accountStatementFromInvoiceLines
 * @property AccountStatementFromInvoiceLines[] $accountStatementFromInvoiceLines0
 * @property AccountSubscription[] $accountSubscriptions
 * @property AccountSubscription[] $accountSubscriptions0
 * @property AccountSubscriptionGenerate[] $accountSubscriptionGenerates
 * @property AccountSubscriptionGenerate[] $accountSubscriptionGenerates0
 * @property AccountSubscriptionLine[] $accountSubscriptionLines
 * @property AccountSubscriptionLine[] $accountSubscriptionLines0
 * @property AccountTax[] $accountTaxes
 * @property AccountTax[] $accountTaxes0
 * @property AccountTaxChart[] $accountTaxCharts
 * @property AccountTaxChart[] $accountTaxCharts0
 * @property AccountTaxCode[] $accountTaxCodes
 * @property AccountTaxCode[] $accountTaxCodes0
 * @property AccountTaxCodeTemplate[] $accountTaxCodeTemplates
 * @property AccountTaxCodeTemplate[] $accountTaxCodeTemplates0
 * @property AccountTaxTemplate[] $accountTaxTemplates
 * @property AccountTaxTemplate[] $accountTaxTemplates0
 * @property AccountUnreconcile[] $accountUnreconciles
 * @property AccountUnreconcile[] $accountUnreconciles0
 * @property AccountUnreconcileReconcile[] $accountUnreconcileReconciles
 * @property AccountUnreconcileReconcile[] $accountUnreconcileReconciles0
 * @property AccountUseModel[] $accountUseModels
 * @property AccountUseModel[] $accountUseModels0
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property AccountVatDeclaration[] $accountVatDeclarations0
 * @property AccountVoucher[] $accountVouchers
 * @property AccountVoucher[] $accountVouchers0
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property AccountVoucherLine[] $accountVoucherLines0
 * @property AccountingLegal[] $accountingLegals
 * @property AccountingLegal[] $accountingLegals0
 * @property AccountingReport[] $accountingReports
 * @property AccountingReport[] $accountingReports0
 * @property ActionTraceability[] $actionTraceabilities
 * @property ActionTraceability[] $actionTraceabilities0
 * @property AfterActualAhad[] $afterActualAhads
 * @property AfterActualAhad[] $afterActualAhads0
 * @property AfterActualJumat[] $afterActualJumats
 * @property AfterActualJumat[] $afterActualJumats0
 * @property AfterActualKamis[] $afterActualKamis
 * @property AfterActualKamis[] $afterActualKamis0
 * @property AfterActualRabu[] $afterActualRabus
 * @property AfterActualRabu[] $afterActualRabus0
 * @property AfterActualSabtu[] $afterActualSabtus
 * @property AfterActualSabtu[] $afterActualSabtus0
 * @property AfterActualSelasa[] $afterActualSelasas
 * @property AfterActualSelasa[] $afterActualSelasas0
 * @property AfterActualSenin[] $afterActualSenins
 * @property AfterActualSenin[] $afterActualSenins0
 * @property AfterPlanAhad[] $afterPlanAhads
 * @property AfterPlanAhad[] $afterPlanAhads0
 * @property AfterPlanJumat[] $afterPlanJumats
 * @property AfterPlanJumat[] $afterPlanJumats0
 * @property AfterPlanKamis[] $afterPlanKamis
 * @property AfterPlanKamis[] $afterPlanKamis0
 * @property AfterPlanRabu[] $afterPlanRabus
 * @property AfterPlanRabu[] $afterPlanRabus0
 * @property AfterPlanSabtu[] $afterPlanSabtus
 * @property AfterPlanSabtu[] $afterPlanSabtus0
 * @property AfterPlanSelasa[] $afterPlanSelasas
 * @property AfterPlanSelasa[] $afterPlanSelasas0
 * @property AfterPlanSenin[] $afterPlanSenins
 * @property AfterPlanSenin[] $afterPlanSenins0
 * @property AssetDepreciationConfirmationWizard[] $assetDepreciationConfirmationWizards
 * @property AssetDepreciationConfirmationWizard[] $assetDepreciationConfirmationWizards0
 * @property AssetModify[] $assetModifies
 * @property AssetModify[] $assetModifies0
 * @property AudittailRulesUsers[] $audittailRulesUsers
 * @property AudittrailRule[] $users
 * @property AudittrailLog[] $audittrailLogs
 * @property AudittrailLog[] $audittrailLogs0
 * @property AudittrailLog[] $audittrailLogs1
 * @property AudittrailLogLine[] $audittrailLogLines
 * @property AudittrailLogLine[] $audittrailLogLines0
 * @property AudittrailRule[] $audittrailRules
 * @property AudittrailRule[] $audittrailRules0
 * @property AudittrailViewLog[] $audittrailViewLogs
 * @property AudittrailViewLog[] $audittrailViewLogs0
 * @property BaseActionRule[] $baseActionRules
 * @property BaseActionRule[] $baseActionRules0
 * @property BaseActionRule[] $baseActionRules1
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests0
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests1
 * @property BaseConfigSettings[] $baseConfigSettings
 * @property BaseConfigSettings[] $baseConfigSettings0
 * @property BaseConfigSettings[] $baseConfigSettings1
 * @property BaseImportImport[] $baseImportImports
 * @property BaseImportImport[] $baseImportImports0
 * @property BaseImportTestsModelsChar[] $baseImportTestsModelsChars
 * @property BaseImportTestsModelsChar[] $baseImportTestsModelsChars0
 * @property BaseImportTestsModelsCharNoreadonly[] $baseImportTestsModelsCharNoreadonlies
 * @property BaseImportTestsModelsCharNoreadonly[] $baseImportTestsModelsCharNoreadonlies0
 * @property BaseImportTestsModelsCharReadonly[] $baseImportTestsModelsCharReadonlies
 * @property BaseImportTestsModelsCharReadonly[] $baseImportTestsModelsCharReadonlies0
 * @property BaseImportTestsModelsCharRequired[] $baseImportTestsModelsCharRequireds
 * @property BaseImportTestsModelsCharRequired[] $baseImportTestsModelsCharRequireds0
 * @property BaseImportTestsModelsCharStates[] $baseImportTestsModelsCharStates
 * @property BaseImportTestsModelsCharStates[] $baseImportTestsModelsCharStates0
 * @property BaseImportTestsModelsCharStillreadonly[] $baseImportTestsModelsCharStillreadonlies
 * @property BaseImportTestsModelsCharStillreadonly[] $baseImportTestsModelsCharStillreadonlies0
 * @property BaseImportTestsModelsM2o[] $baseImportTestsModelsM2os
 * @property BaseImportTestsModelsM2o[] $baseImportTestsModelsM2os0
 * @property BaseImportTestsModelsM2oRelated[] $baseImportTestsModelsM2oRelateds
 * @property BaseImportTestsModelsM2oRelated[] $baseImportTestsModelsM2oRelateds0
 * @property BaseImportTestsModelsM2oRequired[] $baseImportTestsModelsM2oRequireds
 * @property BaseImportTestsModelsM2oRequired[] $baseImportTestsModelsM2oRequireds0
 * @property BaseImportTestsModelsM2oRequiredRelated[] $baseImportTestsModelsM2oRequiredRelateds
 * @property BaseImportTestsModelsM2oRequiredRelated[] $baseImportTestsModelsM2oRequiredRelateds0
 * @property BaseImportTestsModelsO2m[] $baseImportTestsModelsO2ms
 * @property BaseImportTestsModelsO2m[] $baseImportTestsModelsO2ms0
 * @property BaseImportTestsModelsO2mChild[] $baseImportTestsModelsO2mChildren
 * @property BaseImportTestsModelsO2mChild[] $baseImportTestsModelsO2mChildren0
 * @property BaseImportTestsModelsPreview[] $baseImportTestsModelsPreviews
 * @property BaseImportTestsModelsPreview[] $baseImportTestsModelsPreviews0
 * @property BaseLanguageExport[] $baseLanguageExports
 * @property BaseLanguageExport[] $baseLanguageExports0
 * @property BaseLanguageImport[] $baseLanguageImports
 * @property BaseLanguageImport[] $baseLanguageImports0
 * @property BaseLanguageInstall[] $baseLanguageInstalls
 * @property BaseLanguageInstall[] $baseLanguageInstalls0
 * @property BaseModuleConfiguration[] $baseModuleConfigurations
 * @property BaseModuleConfiguration[] $baseModuleConfigurations0
 * @property BaseModuleImport[] $baseModuleImports
 * @property BaseModuleImport[] $baseModuleImports0
 * @property BaseModuleUpdate[] $baseModuleUpdates
 * @property BaseModuleUpdate[] $baseModuleUpdates0
 * @property BaseModuleUpgrade[] $baseModuleUpgrades
 * @property BaseModuleUpgrade[] $baseModuleUpgrades0
 * @property BaseSetupTerminology[] $baseSetupTerminologies
 * @property BaseSetupTerminology[] $baseSetupTerminologies0
 * @property BaseUpdateTranslations[] $baseUpdateTranslations
 * @property BaseUpdateTranslations[] $baseUpdateTranslations0
 * @property BeforeActualAhad[] $beforeActualAhads
 * @property BeforeActualAhad[] $beforeActualAhads0
 * @property BeforeActualJumat[] $beforeActualJumats
 * @property BeforeActualJumat[] $beforeActualJumats0
 * @property BeforeActualKamis[] $beforeActualKamis
 * @property BeforeActualKamis[] $beforeActualKamis0
 * @property BeforeActualRabu[] $beforeActualRabus
 * @property BeforeActualRabu[] $beforeActualRabus0
 * @property BeforeActualSabtu[] $beforeActualSabtus
 * @property BeforeActualSabtu[] $beforeActualSabtus0
 * @property BeforeActualSelasa[] $beforeActualSelasas
 * @property BeforeActualSelasa[] $beforeActualSelasas0
 * @property BeforeActualSenin[] $beforeActualSenins
 * @property BeforeActualSenin[] $beforeActualSenins0
 * @property BeforePlanAhad[] $beforePlanAhads
 * @property BeforePlanAhad[] $beforePlanAhads0
 * @property BeforePlanJumat[] $beforePlanJumats
 * @property BeforePlanJumat[] $beforePlanJumats0
 * @property BeforePlanKamis[] $beforePlanKamis
 * @property BeforePlanKamis[] $beforePlanKamis0
 * @property BeforePlanRabu[] $beforePlanRabus
 * @property BeforePlanRabu[] $beforePlanRabus0
 * @property BeforePlanSabtu[] $beforePlanSabtus
 * @property BeforePlanSabtu[] $beforePlanSabtus0
 * @property BeforePlanSelasa[] $beforePlanSelasas
 * @property BeforePlanSelasa[] $beforePlanSelasas0
 * @property BeforePlanSenin[] $beforePlanSenins
 * @property BeforePlanSenin[] $beforePlanSenins0
 * @property BiayaWorkshop[] $biayaWorkshops
 * @property BiayaWorkshop[] $biayaWorkshops0
 * @property BoardCreate[] $boardCreates
 * @property BoardCreate[] $boardCreates0
 * @property CalendarAlarm[] $calendarAlarms
 * @property CalendarAlarm[] $calendarAlarms0
 * @property CalendarAlarm[] $calendarAlarms1
 * @property CalendarAttendee[] $calendarAttendees
 * @property CalendarAttendee[] $calendarAttendees0
 * @property CalendarAttendee[] $calendarAttendees1
 * @property CalendarEvent[] $calendarEvents
 * @property CalendarEvent[] $calendarEvents0
 * @property CalendarEvent[] $calendarEvents1
 * @property CalendarEvent[] $calendarEvents2
 * @property CalendarTodo[] $calendarTodos
 * @property CalendarTodo[] $calendarTodos0
 * @property CalendarTodo[] $calendarTodos1
 * @property CalendarTodo[] $calendarTodos2
 * @property CashBoxIn[] $cashBoxIns
 * @property CashBoxIn[] $cashBoxIns0
 * @property CashBoxOut[] $cashBoxOuts
 * @property CashBoxOut[] $cashBoxOuts0
 * @property CatatanLine[] $catatanLines
 * @property CatatanLine[] $catatanLines0
 * @property ChangePasswordUser[] $changePasswordUsers
 * @property ChangePasswordUser[] $changePasswordUsers0
 * @property ChangePasswordUser[] $changePasswordUsers1
 * @property ChangePasswordWizard[] $changePasswordWizards
 * @property ChangePasswordWizard[] $changePasswordWizards0
 * @property ChangeProductionQty[] $changeProductionQties
 * @property ChangeProductionQty[] $changeProductionQties0
 * @property CrmMeeting[] $crmMeetings
 * @property CrmMeeting[] $crmMeetings0
 * @property CrmMeeting[] $crmMeetings1
 * @property CrmMeeting[] $crmMeetings2
 * @property CrmMeetingType[] $crmMeetingTypes
 * @property CrmMeetingType[] $crmMeetingTypes0
 * @property DecimalPrecision[] $decimalPrecisions
 * @property DecimalPrecision[] $decimalPrecisions0
 * @property DeliveryCarrier[] $deliveryCarriers
 * @property DeliveryCarrier[] $deliveryCarriers0
 * @property DeliveryGrid[] $deliveryGrs
 * @property DeliveryGrid[] $deliveryGrs0
 * @property DeliveryGridLine[] $deliveryGridLines
 * @property DeliveryGridLine[] $deliveryGridLines0
 * @property DeliveryNote[] $deliveryNotes
 * @property DeliveryNote[] $deliveryNotes0
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property DeliveryNoteLine[] $deliveryNoteLines0
 * @property DeliveryNoteLineReturn[] $deliveryNoteLineReturns
 * @property DeliveryNoteLineReturn[] $deliveryNoteLineReturns0
 * @property DetailOrderLine[] $detailOrderLines
 * @property DetailOrderLine[] $detailOrderLines0
 * @property DetailPb[] $detailPbs
 * @property DetailPb[] $detailPbs0
 * @property DjpTaxRate[] $djpTaxRates
 * @property DjpTaxRate[] $djpTaxRates0
 * @property EksportImport[] $eksportImports
 * @property EksportImport[] $eksportImports0
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplate[] $emailTemplates0
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property EmailTemplatePreview[] $emailTemplatePreviews0
 * @property FetchmailConfigSettings[] $fetchmailConfigSettings
 * @property FetchmailConfigSettings[] $fetchmailConfigSettings0
 * @property FetchmailServer[] $fetchmailServers
 * @property FetchmailServer[] $fetchmailServers0
 * @property GroupSales[] $groupSales
 * @property GroupSales[] $groupSales0
 * @property GroupSalesLine[] $groupSalesLines
 * @property GroupSalesLine[] $groupSalesLines0
 * @property GroupSalesLine[] $groupSalesLines1
 * @property HiredEmployee[] $hiredEmployees
 * @property HiredEmployee[] $hiredEmployees0
 * @property HistoryPayment[] $historyPayments
 * @property HistoryPayment[] $historyPayments0
 * @property HrApplicant[] $hrApplicants
 * @property HrApplicant[] $hrApplicants0
 * @property HrApplicant[] $hrApplicants1
 * @property HrApplicantCategory[] $hrApplicantCategories
 * @property HrApplicantCategory[] $hrApplicantCategories0
 * @property HrAttendanceImportAttendanceLog[] $hrAttendanceImportAttendanceLogs
 * @property HrAttendanceImportAttendanceLog[] $hrAttendanceImportAttendanceLogs0
 * @property HrAttendanceLog[] $hrAttendanceLogs
 * @property HrAttendanceLog[] $hrAttendanceLogs0
 * @property HrAttendanceMachine[] $hrAttendanceMachines
 * @property HrAttendanceMachine[] $hrAttendanceMachines0
 * @property HrAttendanceManualReason[] $hrAttendanceManualReasons
 * @property HrAttendanceManualReason[] $hrAttendanceManualReasons0
 * @property HrAttendanceNonShiftTimetable[] $hrAttendanceNonShiftTimetables
 * @property HrAttendanceNonShiftTimetable[] $hrAttendanceNonShiftTimetables0
 * @property HrAttendanceType[] $hrAttendanceTypes
 * @property HrAttendanceType[] $hrAttendanceTypes0
 * @property HrConfigSettings[] $hrConfigSettings
 * @property HrConfigSettings[] $hrConfigSettings0
 * @property HrDepartment[] $hrDepartments
 * @property HrDepartment[] $hrDepartments0
 * @property HrEmployee[] $hrEmployees
 * @property HrEmployee[] $hrEmployees0
 * @property HrEmployeeCategory[] $hrEmployeeCategories
 * @property HrEmployeeCategory[] $hrEmployeeCategories0
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis0
 * @property HrEmployeePermission[] $hrEmployeePermissions
 * @property HrEmployeePermission[] $hrEmployeePermissions0
 * @property HrEvaluationEvaluation[] $hrEvaluationEvaluations
 * @property HrEvaluationEvaluation[] $hrEvaluationEvaluations0
 * @property HrEvaluationInterview[] $hrEvaluationInterviews
 * @property HrEvaluationInterview[] $hrEvaluationInterviews0
 * @property HrEvaluationPlan[] $hrEvaluationPlans
 * @property HrEvaluationPlan[] $hrEvaluationPlans0
 * @property HrEvaluationPlanPhase[] $hrEvaluationPlanPhases
 * @property HrEvaluationPlanPhase[] $hrEvaluationPlanPhases0
 * @property HrExpenseExpense[] $hrExpenseExpenses
 * @property HrExpenseExpense[] $hrExpenseExpenses0
 * @property HrExpenseExpense[] $hrExpenseExpenses1
 * @property HrExpenseExpense[] $hrExpenseExpenses2
 * @property HrExpenseLine[] $hrExpenseLines
 * @property HrExpenseLine[] $hrExpenseLines0
 * @property HrHolidays[] $hrHolidays
 * @property HrHolidays[] $hrHolidays0
 * @property HrHolidaysStatus[] $hrHolidaysStatuses
 * @property HrHolidaysStatus[] $hrHolidaysStatuses0
 * @property HrHolidaysSummaryDept[] $hrHolidaysSummaryDepts
 * @property HrHolidaysSummaryDept[] $hrHolidaysSummaryDepts0
 * @property HrHolidaysSummaryEmployee[] $hrHolidaysSummaryEmployees
 * @property HrHolidaysSummaryEmployee[] $hrHolidaysSummaryEmployees0
 * @property HrJob[] $hrJobs
 * @property HrJob[] $hrJobs0
 * @property HrRecruitmentDegree[] $hrRecruitmentDegrees
 * @property HrRecruitmentDegree[] $hrRecruitmentDegrees0
 * @property HrRecruitmentPartnerCreate[] $hrRecruitmentPartnerCreates
 * @property HrRecruitmentPartnerCreate[] $hrRecruitmentPartnerCreates0
 * @property HrRecruitmentSource[] $hrRecruitmentSources
 * @property HrRecruitmentSource[] $hrRecruitmentSources0
 * @property HrRecruitmentStage[] $hrRecruitmentStages
 * @property HrRecruitmentStage[] $hrRecruitmentStages0
 * @property InternalMove[] $internalMoves
 * @property InternalMove[] $internalMoves0
 * @property InternalMoveLine[] $internalMoveLines
 * @property InternalMoveLine[] $internalMoveLines0
 * @property InternalMoveLineDetail[] $internalMoveLineDetails
 * @property InternalMoveLineDetail[] $internalMoveLineDetails0
 * @property InternalMoveRequest[] $internalMoveRequests
 * @property InternalMoveRequest[] $internalMoveRequests0
 * @property InternalMoveRequest[] $internalMoveRequests1
 * @property InternalMoveRequestLine[] $internalMoveRequestLines
 * @property InternalMoveRequestLine[] $internalMoveRequestLines0
 * @property IrActWindowView[] $irActWindowViews
 * @property IrActWindowView[] $irActWindowViews0
 * @property IrActions[] $irActions
 * @property IrActions[] $irActions0
 * @property IrActionsConfigurationWizard[] $irActionsConfigurationWizards
 * @property IrActionsConfigurationWizard[] $irActionsConfigurationWizards0
 * @property IrActionsTodo[] $irActionsTodos
 * @property IrActionsTodo[] $irActionsTodos0
 * @property IrAttachment[] $irAttachments
 * @property IrAttachment[] $irAttachments0
 * @property IrConfigParameter[] $irConfigParameters
 * @property IrConfigParameter[] $irConfigParameters0
 * @property IrCron[] $irCrons
 * @property IrCron[] $irCrons0
 * @property IrCron[] $irCrons1
 * @property IrDefault[] $irDefaults
 * @property IrDefault[] $irDefaults0
 * @property IrDefault[] $irDefaults1
 * @property IrExports[] $irExports
 * @property IrExports[] $irExports0
 * @property IrExportsLine[] $irExportsLines
 * @property IrExportsLine[] $irExportsLines0
 * @property IrFieldsConverter[] $irFieldsConverters
 * @property IrFieldsConverter[] $irFieldsConverters0
 * @property IrFilters[] $irFilters
 * @property IrFilters[] $irFilters0
 * @property IrFilters[] $irFilters1
 * @property IrHeaderImg[] $irHeaderImgs
 * @property IrHeaderImg[] $irHeaderImgs0
 * @property IrHeaderWebkit[] $irHeaderWebkits
 * @property IrHeaderWebkit[] $irHeaderWebkits0
 * @property IrMailServer[] $irMailServers
 * @property IrMailServer[] $irMailServers0
 * @property IrModel[] $irModels
 * @property IrModel[] $irModels0
 * @property IrModelAccess[] $irModelAccesses
 * @property IrModelAccess[] $irModelAccesses0
 * @property IrModelFields[] $irModelFields
 * @property IrModelFields[] $irModelFields0
 * @property IrModuleCategory[] $irModuleCategories
 * @property IrModuleCategory[] $irModuleCategories0
 * @property IrModuleModule[] $irModuleModules
 * @property IrModuleModule[] $irModuleModules0
 * @property IrModuleModuleDependency[] $irModuleModuleDependencies
 * @property IrModuleModuleDependency[] $irModuleModuleDependencies0
 * @property IrProperty[] $irProperties
 * @property IrProperty[] $irProperties0
 * @property IrRule[] $irRules
 * @property IrRule[] $irRules0
 * @property IrSequence[] $irSequences
 * @property IrSequence[] $irSequences0
 * @property IrSequenceType[] $irSequenceTypes
 * @property IrSequenceType[] $irSequenceTypes0
 * @property IrServerObjectLines[] $irServerObjectLines
 * @property IrServerObjectLines[] $irServerObjectLines0
 * @property IrUiMenu[] $irUiMenus
 * @property IrUiMenu[] $irUiMenus0
 * @property IrUiView[] $irUiViews
 * @property IrUiView[] $irUiViews0
 * @property IrUiViewCustom[] $irUiViewCustoms
 * @property IrUiViewCustom[] $irUiViewCustoms0
 * @property IrUiViewCustom[] $irUiViewCustoms1
 * @property IrUiViewSc[] $irUiViewScs
 * @property IrUiViewSc[] $irUiViewScs0
 * @property IrUiViewSc[] $irUiViewScs1
 * @property IrValues[] $irValues
 * @property IrValues[] $irValues0
 * @property IrValues[] $irValues1
 * @property LogActivity[] $logActivities
 * @property LogActivity[] $logActivities0
 * @property LogActivity[] $logActivities1
 * @property LogStatusCustomer[] $logStatusCustomers
 * @property LogStatusCustomer[] $logStatusCustomers0
 * @property LogStatusCustomer[] $logStatusCustomers1
 * @property MailAlias[] $mailAliases
 * @property MailAlias[] $mailAliases0
 * @property MailAlias[] $mailAliases1
 * @property MailComposeMessage[] $mailComposeMessages
 * @property MailComposeMessage[] $mailComposeMessages0
 * @property MailGroup[] $mailGroups
 * @property MailGroup[] $mailGroups0
 * @property MailMail[] $mailMails
 * @property MailMail[] $mailMails0
 * @property MailMessage[] $mailMessages
 * @property MailMessage[] $mailMessages0
 * @property MailMessageSubtype[] $mailMessageSubtypes
 * @property MailMessageSubtype[] $mailMessageSubtypes0
 * @property MailVote[] $mailVotes
 * @property MailMessage[] $messages
 * @property MailWizardInvite[] $mailWizardInvites
 * @property MailWizardInvite[] $mailWizardInvites0
 * @property MakeProcurement[] $makeProcurements
 * @property MakeProcurement[] $makeProcurements0
 * @property ManagementSummary[] $managementSummaries
 * @property ManagementSummary[] $managementSummaries0
 * @property ManagementSummary[] $managementSummaries1
 * @property ManyVoucher[] $manyVouchers
 * @property ManyVoucher[] $manyVouchers0
 * @property MergePickings[] $mergePickings
 * @property MergePickings[] $mergePickings0
 * @property MoveSetData[] $moveSetDatas
 * @property MoveSetData[] $moveSetDatas0
 * @property MrpBom[] $mrpBoms
 * @property MrpBom[] $mrpBoms0
 * @property MrpConfigSettings[] $mrpConfigSettings
 * @property MrpConfigSettings[] $mrpConfigSettings0
 * @property MrpProductPrice[] $mrpProductPrices
 * @property MrpProductPrice[] $mrpProductPrices0
 * @property MrpProductProduce[] $mrpProductProduces
 * @property MrpProductProduce[] $mrpProductProduces0
 * @property MrpProduction[] $mrpProductions
 * @property MrpProduction[] $mrpProductions0
 * @property MrpProduction[] $mrpProductions1
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MrpProductionProductLine[] $mrpProductionProductLines0
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines0
 * @property MrpProperty[] $mrpProperties
 * @property MrpProperty[] $mrpProperties0
 * @property MrpPropertyGroup[] $mrpPropertyGroups
 * @property MrpPropertyGroup[] $mrpPropertyGroups0
 * @property MrpRouting[] $mrpRoutings
 * @property MrpRouting[] $mrpRoutings0
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters0
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property MrpWorkcenter[] $mrpWorkcenters0
 * @property MrpWorkcenterLoad[] $mrpWorkcenterLoads
 * @property MrpWorkcenterLoad[] $mrpWorkcenterLoads0
 * @property MultiCompanyDefault[] $multiCompanyDefaults
 * @property MultiCompanyDefault[] $multiCompanyDefaults0
 * @property MutasiAccount[] $mutasiAccounts
 * @property MutasiAccount[] $mutasiAccounts0
 * @property MutasiStock[] $mutasiStocks
 * @property MutasiStock[] $mutasiStocks0
 * @property OrderPreparation[] $orderPreparations
 * @property OrderPreparation[] $orderPreparations0
 * @property OrderPreparationBatch[] $orderPreparationBatches
 * @property OrderPreparationBatch[] $orderPreparationBatches0
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property OrderPreparationLine[] $orderPreparationLines0
 * @property OrderRequisitionDelivery[] $orderRequisitionDeliveries
 * @property OrderRequisitionDelivery[] $orderRequisitionDeliveries0
 * @property OrderRequisitionDelivery[] $orderRequisitionDeliveries1
 * @property OrderRequisitionDelivery[] $orderRequisitionDeliveries2
 * @property OrderRequisitionDelivery[] $orderRequisitionDeliveries3
 * @property OrderRequisitionDelivery[] $orderRequisitionDeliveries4
 * @property OrderRequisitionDeliveryLine[] $orderRequisitionDeliveryLines
 * @property OrderRequisitionDeliveryLine[] $orderRequisitionDeliveryLines0
 * @property OrderRequisitionDeliveryLinePo[] $orderRequisitionDeliveryLinePos
 * @property OrderRequisitionDeliveryLinePo[] $orderRequisitionDeliveryLinePos0
 * @property OsvMemoryAutovacuum[] $osvMemoryAutovacuums
 * @property OsvMemoryAutovacuum[] $osvMemoryAutovacuums0
 * @property PackingListLine[] $packingListLines
 * @property PackingListLine[] $packingListLines0
 * @property PembelianBarang[] $pembelianBarangs
 * @property PembelianBarang[] $pembelianBarangs0
 * @property PerintahKerja[] $perintahKerjas
 * @property PerintahKerja[] $perintahKerjas0
 * @property PerintahKerja[] $perintahKerjas1
 * @property PerintahKerja[] $perintahKerjas2
 * @property PerintahKerja[] $perintahKerjas3
 * @property PerintahKerjaInternal[] $perintahKerjaInternals
 * @property PerintahKerjaInternal[] $perintahKerjaInternals0
 * @property PerintahKerjaInternal[] $perintahKerjaInternals1
 * @property PerintahKerjaInternal[] $perintahKerjaInternals2
 * @property PerintahKerjaInternal[] $perintahKerjaInternals3
 * @property PerintahKerjaLine[] $perintahKerjaLines
 * @property PerintahKerjaLine[] $perintahKerjaLines0
 * @property PerintahKerjaLineInternal[] $perintahKerjaLineInternals
 * @property PerintahKerjaLineInternal[] $perintahKerjaLineInternals0
 * @property Port[] $ports
 * @property Port[] $ports0
 * @property PortalPaymentAcquirer[] $portalPaymentAcquirers
 * @property PortalPaymentAcquirer[] $portalPaymentAcquirers0
 * @property PortalWizard[] $portalWizards
 * @property PortalWizard[] $portalWizards0
 * @property PortalWizardUser[] $portalWizardUsers
 * @property PortalWizardUser[] $portalWizardUsers0
 * @property Pr[] $prs
 * @property Pr[] $prs0
 * @property Pr[] $prs1
 * @property PricelistPartnerinfo[] $pricelistPartnerinfos
 * @property PricelistPartnerinfo[] $pricelistPartnerinfos0
 * @property ProcessCondition[] $processConditions
 * @property ProcessCondition[] $processConditions0
 * @property ProcessNode[] $processNodes
 * @property ProcessNode[] $processNodes0
 * @property ProcessProcess[] $processProcesses
 * @property ProcessProcess[] $processProcesses0
 * @property ProcessTransition[] $processTransitions
 * @property ProcessTransition[] $processTransitions0
 * @property ProcessTransitionAction[] $processTransitionActions
 * @property ProcessTransitionAction[] $processTransitionActions0
 * @property ProcurementOrder[] $procurementOrders
 * @property ProcurementOrder[] $procurementOrders0
 * @property ProcurementOrderCompute[] $procurementOrderComputes
 * @property ProcurementOrderCompute[] $procurementOrderComputes0
 * @property ProcurementOrderComputeAll[] $procurementOrderComputeAlls
 * @property ProcurementOrderComputeAll[] $procurementOrderComputeAlls0
 * @property ProcurementOrderpointCompute[] $procurementOrderpointComputes
 * @property ProcurementOrderpointCompute[] $procurementOrderpointComputes0
 * @property ProductBatchLine[] $productBatchLines
 * @property ProductBatchLine[] $productBatchLines0
 * @property ProductCategory[] $productCategories
 * @property ProductCategory[] $productCategories0
 * @property ProductListLine[] $productListLines
 * @property ProductListLine[] $productListLines0
 * @property ProductPackaging[] $productPackagings
 * @property ProductPackaging[] $productPackagings0
 * @property ProductPriceList[] $productPriceLists
 * @property ProductPriceList[] $productPriceLists0
 * @property ProductPriceType[] $productPriceTypes
 * @property ProductPriceType[] $productPriceTypes0
 * @property ProductPricelist[] $productPricelists
 * @property ProductPricelist[] $productPricelists0
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductPricelistItem[] $productPricelistItems0
 * @property ProductPricelistType[] $productPricelistTypes
 * @property ProductPricelistType[] $productPricelistTypes0
 * @property ProductPricelistVersion[] $productPricelistVersions
 * @property ProductPricelistVersion[] $productPricelistVersions0
 * @property ProductProduct[] $productProducts
 * @property ProductProduct[] $productProducts0
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property ProductSupplierinfo[] $productSupplierinfos0
 * @property ProductTemplate[] $productTemplates
 * @property ProductTemplate[] $productTemplates0
 * @property ProductTemplate[] $productTemplates1
 * @property ProductUl[] $productUls
 * @property ProductUl[] $productUls0
 * @property ProductUom[] $productUoms
 * @property ProductUom[] $productUoms0
 * @property ProductUomCateg[] $productUomCategs
 * @property ProductUomCateg[] $productUomCategs0
 * @property ProductVariants[] $productVariants
 * @property ProductVariants[] $productVariants0
 * @property ProjectAccountAnalyticLine[] $projectAccountAnalyticLines
 * @property ProjectAccountAnalyticLine[] $projectAccountAnalyticLines0
 * @property PublisherWarrantyContract[] $publisherWarrantyContracts
 * @property PublisherWarrantyContract[] $publisherWarrantyContracts0
 * @property PurchaseConfigSettings[] $purchaseConfigSettings
 * @property PurchaseConfigSettings[] $purchaseConfigSettings0
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrder[] $purchaseOrders0
 * @property PurchaseOrder[] $purchaseOrders1
 * @property PurchaseOrderGroup[] $purchaseOrderGroups
 * @property PurchaseOrderGroup[] $purchaseOrderGroups0
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property PurchaseOrderLine[] $purchaseOrderLines0
 * @property PurchaseOrderLineCancel[] $purchaseOrderLineCancels
 * @property PurchaseOrderLineCancel[] $purchaseOrderLineCancels0
 * @property PurchaseOrderLineCancel[] $purchaseOrderLineCancels1
 * @property PurchaseOrderLineFromRequisitionLines[] $purchaseOrderLineFromRequisitionLines
 * @property PurchaseOrderLineFromRequisitionLines[] $purchaseOrderLineFromRequisitionLines0
 * @property PurchaseOrderLineInvoice[] $purchaseOrderLineInvoices
 * @property PurchaseOrderLineInvoice[] $purchaseOrderLineInvoices0
 * @property PurchaseOrderRevision[] $purchaseOrderRevisions
 * @property PurchaseOrderRevision[] $purchaseOrderRevisions0
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines0
 * @property PurchasePartialInvoice[] $purchasePartialInvoices
 * @property PurchasePartialInvoice[] $purchasePartialInvoices0
 * @property PurchaseRequisitionSubcont[] $purchaseRequisitionSubconts
 * @property PurchaseRequisitionSubcont[] $purchaseRequisitionSubconts0
 * @property PurchaseRequisitionSubcont[] $purchaseRequisitionSubconts1
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines0
 * @property PurchaseRequisitionSubcontLineToSend[] $purchaseRequisitionSubcontLineToSends
 * @property PurchaseRequisitionSubcontLineToSend[] $purchaseRequisitionSubcontLineToSends0
 * @property PurchaseRequisitionSubcontSendLine[] $purchaseRequisitionSubcontSendLines
 * @property PurchaseRequisitionSubcontSendLine[] $purchaseRequisitionSubcontSendLines0
 * @property RawMaterialLine[] $rawMaterialLines
 * @property RawMaterialLine[] $rawMaterialLines0
 * @property RemainderSalesman[] $remainderSalesmen
 * @property RemainderSalesman[] $remainderSalesmen0
 * @property RemainderSalesman[] $remainderSalesmen1
 * @property RentRequisition[] $rentRequisitions
 * @property RentRequisition[] $rentRequisitions0
 * @property RentRequisitionDetail[] $rentRequisitionDetails
 * @property RentRequisitionDetail[] $rentRequisitionDetails0
 * @property ReportSaldoAkhir[] $reportSaldoAkhirs
 * @property ReportSaldoAkhir[] $reportSaldoAkhirs0
 * @property ReportTransaksiAccount[] $reportTransaksiAccounts
 * @property ReportTransaksiAccount[] $reportTransaksiAccounts0
 * @property ReportWebkitActions[] $reportWebkitActions
 * @property ReportWebkitActions[] $reportWebkitActions0
 * @property ResAlarm[] $resAlarms
 * @property ResAlarm[] $resAlarms0
 * @property ResBank[] $resBanks
 * @property ResBank[] $resBanks0
 * @property ResCompany[] $resCompanies
 * @property ResCompany[] $resCompanies0
 * @property ResCompanyUsersRel[] $resCompanyUsersRels
 * @property ResCompany[] $cs
 * @property ResConfig[] $resConfigs
 * @property ResConfig[] $resConfigs0
 * @property ResConfigInstaller[] $resConfigInstallers
 * @property ResConfigInstaller[] $resConfigInstallers0
 * @property ResConfigSettings[] $resConfigSettings
 * @property ResConfigSettings[] $resConfigSettings0
 * @property ResCountry[] $resCountries
 * @property ResCountry[] $resCountries0
 * @property ResCountryState[] $resCountryStates
 * @property ResCountryState[] $resCountryStates0
 * @property ResCurrency[] $resCurrencies
 * @property ResCurrency[] $resCurrencies0
 * @property ResCurrencyRate[] $resCurrencyRates
 * @property ResCurrencyRate[] $resCurrencyRates0
 * @property ResCurrencyRateType[] $resCurrencyRateTypes
 * @property ResCurrencyRateType[] $resCurrencyRateTypes0
 * @property ResGroups[] $resGroups
 * @property ResGroups[] $resGroups0
 * @property ResGroupsUsersRel[] $resGroupsUsersRels
 * @property ResGroups[] $gs
 * @property ResLang[] $resLangs
 * @property ResLang[] $resLangs0
 * @property ResPartner[] $resPartners
 * @property ResPartner[] $resPartners0
 * @property ResPartner[] $resPartners1
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResPartnerBank[] $resPartnerBanks0
 * @property ResPartnerBankType[] $resPartnerBankTypes
 * @property ResPartnerBankType[] $resPartnerBankTypes0
 * @property ResPartnerBankTypeField[] $resPartnerBankTypeFields
 * @property ResPartnerBankTypeField[] $resPartnerBankTypeFields0
 * @property ResPartnerCategory[] $resPartnerCategories
 * @property ResPartnerCategory[] $resPartnerCategories0
 * @property ResPartnerTitle[] $resPartnerTitles
 * @property ResPartnerTitle[] $resPartnerTitles0
 * @property ResRequest[] $resRequests
 * @property ResRequest[] $resRequests0
 * @property ResRequest[] $resRequests1
 * @property ResRequest[] $resRequests2
 * @property ResRequestHistory[] $resRequestHistories
 * @property ResRequestHistory[] $resRequestHistories0
 * @property ResRequestHistory[] $resRequestHistories1
 * @property ResRequestHistory[] $resRequestHistories2
 * @property ResRequestLink[] $resRequestLinks
 * @property ResRequestLink[] $resRequestLinks0
 * @property GroupSales $kelompok
 * @property MailAlias $alias
 * @property ResCompany $company
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property ResUsers[] $resUsers
 * @property ResUsers $writeU
 * @property ResUsers[] $resUsers0
 * @property ResetStatus[] $resetStatuses
 * @property ResetStatus[] $resetStatuses0
 * @property ResourceCalendar[] $resourceCalendars
 * @property ResourceCalendar[] $resourceCalendars0
 * @property ResourceCalendar[] $resourceCalendars1
 * @property ResourceCalendarAttendance[] $resourceCalendarAttendances
 * @property ResourceCalendarAttendance[] $resourceCalendarAttendances0
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves0
 * @property ResourceResource[] $resourceResources
 * @property ResourceResource[] $resourceResources0
 * @property ResourceResource[] $resourceResources1
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs0
 * @property SaleConfigSettings[] $saleConfigSettings
 * @property SaleConfigSettings[] $saleConfigSettings0
 * @property SaleMakeInvoice[] $saleMakeInvoices
 * @property SaleMakeInvoice[] $saleMakeInvoices0
 * @property SaleOrder[] $saleOrders
 * @property SaleOrder[] $saleOrders0
 * @property SaleOrder[] $saleOrders1
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleOrderLine[] $saleOrderLines0
 * @property SaleOrderLine[] $saleOrderLines1
 * @property SaleOrderLineFromRequisitionLines[] $saleOrderLineFromRequisitionLines
 * @property SaleOrderLineFromRequisitionLines[] $saleOrderLineFromRequisitionLines0
 * @property SaleOrderLineMakeInvoice[] $saleOrderLineMakeInvoices
 * @property SaleOrderLineMakeInvoice[] $saleOrderLineMakeInvoices0
 * @property SaleOrderSummary[] $saleOrderSummaries
 * @property SaleOrderSummary[] $saleOrderSummaries0
 * @property SaleShop[] $saleShops
 * @property SaleShop[] $saleShops0
 * @property SalesActivity[] $salesActivities
 * @property SalesActivity[] $salesActivities0
 * @property SalesActivity[] $salesActivities1
 * @property SalesManTarget[] $salesManTargets
 * @property SalesManTarget[] $salesManTargets0
 * @property SalesManTarget[] $salesManTargets1
 * @property ScopeWorkCustomer[] $scopeWorkCustomers
 * @property ScopeWorkCustomer[] $scopeWorkCustomers0
 * @property ScopeWorkSupra[] $scopeWorkSupras
 * @property ScopeWorkSupra[] $scopeWorkSupras0
 * @property SetPo[] $setPos
 * @property SetPo[] $setPos0
 * @property ShareWizard[] $shareWizards
 * @property ShareWizard[] $shareWizards0
 * @property ShareWizardResUserRel[] $shareWizardResUserRels
 * @property ShareWizard[] $shares
 * @property ShareWizardResultLine[] $shareWizardResultLines
 * @property ShareWizardResultLine[] $shareWizardResultLines0
 * @property ShareWizardResultLine[] $shareWizardResultLines1
 * @property StatusSubline[] $statusSublines
 * @property StatusSubline[] $statusSublines0
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockChangeProductQty[] $stockChangeProductQties0
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices0
 * @property StockConfigSettings[] $stockConfigSettings
 * @property StockConfigSettings[] $stockConfigSettings0
 * @property StockFillInventory[] $stockFillInventories
 * @property StockFillInventory[] $stockFillInventories0
 * @property StockIncoterms[] $stockIncoterms
 * @property StockIncoterms[] $stockIncoterms0
 * @property StockInventory[] $stockInventories
 * @property StockInventory[] $stockInventories0
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockInventoryLine[] $stockInventoryLines0
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits0
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines0
 * @property StockInventoryMerge[] $stockInventoryMerges
 * @property StockInventoryMerge[] $stockInventoryMerges0
 * @property StockInvoiceOnshipping[] $stockInvoiceOnshippings
 * @property StockInvoiceOnshipping[] $stockInvoiceOnshippings0
 * @property StockJournal[] $stockJournals
 * @property StockJournal[] $stockJournals0
 * @property StockJournal[] $stockJournals1
 * @property StockLocation[] $stockLocations
 * @property StockLocation[] $stockLocations0
 * @property StockLocationProduct[] $stockLocationProducts
 * @property StockLocationProduct[] $stockLocationProducts0
 * @property StockMove[] $stockMoves
 * @property StockMove[] $stockMoves0
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockMoveConsume[] $stockMoveConsumes0
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveScrap[] $stockMoveScraps0
 * @property StockMoveSplit[] $stockMoveSplits
 * @property StockMoveSplit[] $stockMoveSplits0
 * @property StockMoveSplitLines[] $stockMoveSplitLines
 * @property StockMoveSplitLines[] $stockMoveSplitLines0
 * @property StockPartialMove[] $stockPartialMoves
 * @property StockPartialMove[] $stockPartialMoves0
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines0
 * @property StockPartialPicking[] $stockPartialPickings
 * @property StockPartialPicking[] $stockPartialPickings0
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockPartialPickingLine[] $stockPartialPickingLines0
 * @property StockPicking[] $stockPickings
 * @property StockPicking[] $stockPickings0
 * @property StockProductionLot[] $stockProductionLots
 * @property StockProductionLot[] $stockProductionLots0
 * @property StockProductionLotRevision[] $stockProductionLotRevisions
 * @property StockProductionLotRevision[] $stockProductionLotRevisions0
 * @property StockProductionLotRevision[] $stockProductionLotRevisions1
 * @property StockReturnPicking[] $stockReturnPickings
 * @property StockReturnPicking[] $stockReturnPickings0
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories0
 * @property StockSplitInto[] $stockSplitIntos
 * @property StockSplitInto[] $stockSplitIntos0
 * @property StockTracking[] $stockTrackings
 * @property StockTracking[] $stockTrackings0
 * @property StockWarehouse[] $stockWarehouses
 * @property StockWarehouse[] $stockWarehouses0
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints0
 * @property SuperNotes[] $superNotes
 * @property SuperNotes[] $superNotes0
 * @property Survey[] $surveys
 * @property Survey[] $surveys0
 * @property Survey[] $surveys1
 * @property SurveyAnswer[] $surveyAnswers
 * @property SurveyAnswer[] $surveyAnswers0
 * @property SurveyBrowseAnswer[] $surveyBrowseAnswers
 * @property SurveyBrowseAnswer[] $surveyBrowseAnswers0
 * @property SurveyHistory[] $surveyHistories
 * @property SurveyHistory[] $surveyHistories0
 * @property SurveyHistory[] $surveyHistories1
 * @property SurveyInvitedUserRel[] $surveyInvitedUserRels
 * @property Survey[] $s
 * @property SurveyNameWiz[] $surveyNameWizs
 * @property SurveyNameWiz[] $surveyNameWizs0
 * @property SurveyPage[] $surveyPages
 * @property SurveyPage[] $surveyPages0
 * @property SurveyPrint[] $surveyPrints
 * @property SurveyPrint[] $surveyPrints0
 * @property SurveyPrintAnswer[] $surveyPrintAnswers
 * @property SurveyPrintAnswer[] $surveyPrintAnswers0
 * @property SurveyPrintStatistics[] $surveyPrintStatistics
 * @property SurveyPrintStatistics[] $surveyPrintStatistics0
 * @property SurveyQuestion[] $surveyQuestions
 * @property SurveyQuestion[] $surveyQuestions0
 * @property SurveyQuestionColumnHeading[] $surveyQuestionColumnHeadings
 * @property SurveyQuestionColumnHeading[] $surveyQuestionColumnHeadings0
 * @property SurveyQuestionWiz[] $surveyQuestionWizs
 * @property SurveyQuestionWiz[] $surveyQuestionWizs0
 * @property SurveyRequest[] $surveyRequests
 * @property SurveyRequest[] $surveyRequests0
 * @property SurveyRequest[] $surveyRequests1
 * @property SurveyResponse[] $surveyResponses
 * @property SurveyResponse[] $surveyResponses0
 * @property SurveyResponse[] $surveyResponses1
 * @property SurveyResponseAnswer[] $surveyResponseAnswers
 * @property SurveyResponseAnswer[] $surveyResponseAnswers0
 * @property SurveyResponseLine[] $surveyResponseLines
 * @property SurveyResponseLine[] $surveyResponseLines0
 * @property SurveySendInvitation[] $surveySendInvitations
 * @property SurveySendInvitation[] $surveySendInvitations0
 * @property SurveySendInvitationLog[] $surveySendInvitationLogs
 * @property SurveySendInvitationLog[] $surveySendInvitationLogs0
 * @property SurveyTblColumnHeading[] $surveyTblColumnHeadings
 * @property SurveyTblColumnHeading[] $surveyTblColumnHeadings0
 * @property SurveyType[] $surveyTypes
 * @property SurveyType[] $surveyTypes0
 * @property SurveyUsersRel[] $surveyUsersRels
 * @property Survey[] $s0
 * @property TempRange[] $tempRanges
 * @property TempRange[] $tempRanges0
 * @property TermCondition[] $termConditions
 * @property TermCondition[] $termConditions0
 * @property TypePb[] $typePbs
 * @property TypePb[] $typePbs0
 * @property ValidateAccountMove[] $validateAccountMoves
 * @property ValidateAccountMove[] $validateAccountMoves0
 * @property ValidateAccountMoveLines[] $validateAccountMoveLines
 * @property ValidateAccountMoveLines[] $validateAccountMoveLines0
 * @property WeekStatus[] $weekStatuses
 * @property WeekStatus[] $weekStatuses0
 * @property WeekStatus[] $weekStatuses1
 * @property WeekStatusLine[] $weekStatusLines
 * @property WeekStatusLine[] $weekStatusLines0
 * @property WizardActivity[] $wizardActivities
 * @property WizardActivity[] $wizardActivities0
 * @property WizardActivity[] $wizardActivities1
 * @property WizardAfterActualAhad[] $wizardAfterActualAhads
 * @property WizardAfterActualAhad[] $wizardAfterActualAhads0
 * @property WizardAfterActualJumat[] $wizardAfterActualJumats
 * @property WizardAfterActualJumat[] $wizardAfterActualJumats0
 * @property WizardAfterActualKamis[] $wizardAfterActualKamis
 * @property WizardAfterActualKamis[] $wizardAfterActualKamis0
 * @property WizardAfterActualRabu[] $wizardAfterActualRabus
 * @property WizardAfterActualRabu[] $wizardAfterActualRabus0
 * @property WizardAfterActualSabtu[] $wizardAfterActualSabtus
 * @property WizardAfterActualSabtu[] $wizardAfterActualSabtus0
 * @property WizardAfterActualSelasa[] $wizardAfterActualSelasas
 * @property WizardAfterActualSelasa[] $wizardAfterActualSelasas0
 * @property WizardAfterActualSenin[] $wizardAfterActualSenins
 * @property WizardAfterActualSenin[] $wizardAfterActualSenins0
 * @property WizardAfterPlanAhad[] $wizardAfterPlanAhads
 * @property WizardAfterPlanAhad[] $wizardAfterPlanAhads0
 * @property WizardAfterPlanJumat[] $wizardAfterPlanJumats
 * @property WizardAfterPlanJumat[] $wizardAfterPlanJumats0
 * @property WizardAfterPlanKamis[] $wizardAfterPlanKamis
 * @property WizardAfterPlanKamis[] $wizardAfterPlanKamis0
 * @property WizardAfterPlanRabu[] $wizardAfterPlanRabus
 * @property WizardAfterPlanRabu[] $wizardAfterPlanRabus0
 * @property WizardAfterPlanSabtu[] $wizardAfterPlanSabtus
 * @property WizardAfterPlanSabtu[] $wizardAfterPlanSabtus0
 * @property WizardAfterPlanSelasa[] $wizardAfterPlanSelasas
 * @property WizardAfterPlanSelasa[] $wizardAfterPlanSelasas0
 * @property WizardAfterPlanSenin[] $wizardAfterPlanSenins
 * @property WizardAfterPlanSenin[] $wizardAfterPlanSenins0
 * @property WizardBeforeActualAhad[] $wizardBeforeActualAhads
 * @property WizardBeforeActualAhad[] $wizardBeforeActualAhads0
 * @property WizardBeforeActualJumat[] $wizardBeforeActualJumats
 * @property WizardBeforeActualJumat[] $wizardBeforeActualJumats0
 * @property WizardBeforeActualKamis[] $wizardBeforeActualKamis
 * @property WizardBeforeActualKamis[] $wizardBeforeActualKamis0
 * @property WizardBeforeActualRabu[] $wizardBeforeActualRabus
 * @property WizardBeforeActualRabu[] $wizardBeforeActualRabus0
 * @property WizardBeforeActualSabtu[] $wizardBeforeActualSabtus
 * @property WizardBeforeActualSabtu[] $wizardBeforeActualSabtus0
 * @property WizardBeforeActualSelasa[] $wizardBeforeActualSelasas
 * @property WizardBeforeActualSelasa[] $wizardBeforeActualSelasas0
 * @property WizardBeforeActualSenin[] $wizardBeforeActualSenins
 * @property WizardBeforeActualSenin[] $wizardBeforeActualSenins0
 * @property WizardBeforePlanAhad[] $wizardBeforePlanAhads
 * @property WizardBeforePlanAhad[] $wizardBeforePlanAhads0
 * @property WizardBeforePlanJumat[] $wizardBeforePlanJumats
 * @property WizardBeforePlanJumat[] $wizardBeforePlanJumats0
 * @property WizardBeforePlanKamis[] $wizardBeforePlanKamis
 * @property WizardBeforePlanKamis[] $wizardBeforePlanKamis0
 * @property WizardBeforePlanRabu[] $wizardBeforePlanRabus
 * @property WizardBeforePlanRabu[] $wizardBeforePlanRabus0
 * @property WizardBeforePlanSabtu[] $wizardBeforePlanSabtus
 * @property WizardBeforePlanSabtu[] $wizardBeforePlanSabtus0
 * @property WizardBeforePlanSelasa[] $wizardBeforePlanSelasas
 * @property WizardBeforePlanSelasa[] $wizardBeforePlanSelasas0
 * @property WizardBeforePlanSenin[] $wizardBeforePlanSenins
 * @property WizardBeforePlanSenin[] $wizardBeforePlanSenins0
 * @property WizardCreatePb[] $wizardCreatePbs
 * @property WizardCreatePb[] $wizardCreatePbs0
 * @property WizardCreatePbLine[] $wizardCreatePbLines
 * @property WizardCreatePbLine[] $wizardCreatePbLines0
 * @property WizardDetailPb[] $wizardDetailPbs
 * @property WizardDetailPb[] $wizardDetailPbs0
 * @property WizardIrModelMenuCreate[] $wizardIrModelMenuCreates
 * @property WizardIrModelMenuCreate[] $wizardIrModelMenuCreates0
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts0
 * @property WizardPoCancelItem[] $wizardPoCancelItems
 * @property WizardPoCancelItem[] $wizardPoCancelItems0
 * @property WizardPoCancelItemLine[] $wizardPoCancelItemLines
 * @property WizardPoCancelItemLine[] $wizardPoCancelItemLines0
 * @property WizardPoRent[] $wizardPoRents
 * @property WizardPoRent[] $wizardPoRents0
 * @property WizardPoRevise[] $wizardPoRevises
 * @property WizardPoRevise[] $wizardPoRevises0
 * @property WizardPrCancelItem[] $wizardPrCancelItems
 * @property WizardPrCancelItem[] $wizardPrCancelItems0
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails0
 * @property WizardStockByLocation[] $wizardStockByLocations
 * @property WizardStockByLocation[] $wizardStockByLocations0
 * @property WizardStockByLocationLine[] $wizardStockByLocationLines
 * @property WizardStockByLocationLine[] $wizardStockByLocationLines0
 * @property WizardSupplierFirstPayment[] $wizardSupplierFirstPayments
 * @property WizardSupplierFirstPayment[] $wizardSupplierFirstPayments0
 * @property Wkf[] $wkfs
 * @property Wkf[] $wkfs0
 * @property WkfActivity[] $wkfActivities
 * @property WkfActivity[] $wkfActivities0
 * @property WkfLogs[] $wkfLogs
 * @property WkfTransition[] $wkfTransitions
 * @property WkfTransition[] $wkfTransitions0
 */
class ResUsers extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'share'], 'boolean'],
            [['login', 'company_id', 'partner_id', 'alias_id'], 'required'],
            [['company_id', 'partner_id', 'create_uid', 'write_uid', 'menu_id', 'action_id', 'alias_id', 'kelompok_id'], 'integer'],
            [['create_date', 'write_date', 'login_date'], 'safe'],
            [['signature'], 'string'],
            [['login', 'password'], 'string', 'max' => 64],
            [['initial'], 'string', 'max' => 254],
            [['login'], 'unique'],
            [['login'], 'unique'],
            [['kelompok_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupSales::className(), 'targetAttribute' => ['kelompok_id' => 'id']],
            [['alias_id'], 'exist', 'skipOnError' => true, 'targetClass' => MailAlias::className(), 'targetAttribute' => ['alias_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResCompany::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResPartner::className(), 'targetAttribute' => ['partner_id' => 'id']],
            [['create_uid'], 'exist', 'skipOnError' => true, 'targetClass' => ResUsers::className(), 'targetAttribute' => ['create_uid' => 'id']],
            [['write_uid'], 'exist', 'skipOnError' => true, 'targetClass' => ResUsers::className(), 'targetAttribute' => ['write_uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'login' => 'Login',
            'password' => 'Password',
            'company_id' => 'Company ID',
            'partner_id' => 'Partner ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'menu_id' => 'Menu ID',
            'login_date' => 'Login Date',
            'signature' => 'Signature',
            'action_id' => 'Action ID',
            'alias_id' => 'Alias ID',
            'share' => 'Share',
            'initial' => 'Initial',
            'kelompok_id' => 'Kelompok ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccounts()
    {
        return $this->hasMany(AccountAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccounts0()
    {
        return $this->hasMany(AccountAccount::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTemplates()
    {
        return $this->hasMany(AccountAccountTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTemplates0()
    {
        return $this->hasMany(AccountAccountTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTypes()
    {
        return $this->hasMany(AccountAccountType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTypes0()
    {
        return $this->hasMany(AccountAccountType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAddtmplWizards()
    {
        return $this->hasMany(AccountAddtmplWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAddtmplWizards0()
    {
        return $this->hasMany(AccountAddtmplWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAgedTrialBalances()
    {
        return $this->hasMany(AccountAgedTrialBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAgedTrialBalances0()
    {
        return $this->hasMany(AccountAgedTrialBalance::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticAccounts()
    {
        return $this->hasMany(AccountAnalyticAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticAccounts0()
    {
        return $this->hasMany(AccountAnalyticAccount::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticAccounts1()
    {
        return $this->hasMany(AccountAnalyticAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticAccounts2()
    {
        return $this->hasMany(AccountAnalyticAccount::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticBalances()
    {
        return $this->hasMany(AccountAnalyticBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticBalances0()
    {
        return $this->hasMany(AccountAnalyticBalance::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCharts()
    {
        return $this->hasMany(AccountAnalyticChart::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCharts0()
    {
        return $this->hasMany(AccountAnalyticChart::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCostLedgers()
    {
        return $this->hasMany(AccountAnalyticCostLedger::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCostLedgers0()
    {
        return $this->hasMany(AccountAnalyticCostLedger::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCostLedgerJournalReports()
    {
        return $this->hasMany(AccountAnalyticCostLedgerJournalReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCostLedgerJournalReports0()
    {
        return $this->hasMany(AccountAnalyticCostLedgerJournalReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticInvertedBalances()
    {
        return $this->hasMany(AccountAnalyticInvertedBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticInvertedBalances0()
    {
        return $this->hasMany(AccountAnalyticInvertedBalance::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticJournals()
    {
        return $this->hasMany(AccountAnalyticJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticJournals0()
    {
        return $this->hasMany(AccountAnalyticJournal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticJournalReports()
    {
        return $this->hasMany(AccountAnalyticJournalReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticJournalReports0()
    {
        return $this->hasMany(AccountAnalyticJournalReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines0()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines1()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetAssets()
    {
        return $this->hasMany(AccountAssetAsset::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetAssets0()
    {
        return $this->hasMany(AccountAssetAsset::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetCategories()
    {
        return $this->hasMany(AccountAssetCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetCategories0()
    {
        return $this->hasMany(AccountAssetCategory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetDepreciationLines()
    {
        return $this->hasMany(AccountAssetDepreciationLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetDepreciationLines0()
    {
        return $this->hasMany(AccountAssetDepreciationLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetHistories()
    {
        return $this->hasMany(AccountAssetHistory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetHistories0()
    {
        return $this->hasMany(AccountAssetHistory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetHistories1()
    {
        return $this->hasMany(AccountAssetHistory::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAutomaticReconciles()
    {
        return $this->hasMany(AccountAutomaticReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAutomaticReconciles0()
    {
        return $this->hasMany(AccountAutomaticReconcile::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBalanceReports()
    {
        return $this->hasMany(AccountBalanceReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBalanceReports0()
    {
        return $this->hasMany(AccountBalanceReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankAccountsWizards()
    {
        return $this->hasMany(AccountBankAccountsWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankAccountsWizards0()
    {
        return $this->hasMany(AccountBankAccountsWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatements()
    {
        return $this->hasMany(AccountBankStatement::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatements0()
    {
        return $this->hasMany(AccountBankStatement::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatements1()
    {
        return $this->hasMany(AccountBankStatement::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatementLines()
    {
        return $this->hasMany(AccountBankStatementLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatementLines0()
    {
        return $this->hasMany(AccountBankStatementLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCashboxLines()
    {
        return $this->hasMany(AccountCashboxLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCashboxLines0()
    {
        return $this->hasMany(AccountCashboxLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCentralJournals()
    {
        return $this->hasMany(AccountCentralJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCentralJournals0()
    {
        return $this->hasMany(AccountCentralJournal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChangeCurrencies()
    {
        return $this->hasMany(AccountChangeCurrency::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChangeCurrencies0()
    {
        return $this->hasMany(AccountChangeCurrency::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCharts()
    {
        return $this->hasMany(AccountChart::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCharts0()
    {
        return $this->hasMany(AccountChart::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChartTemplates()
    {
        return $this->hasMany(AccountChartTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChartTemplates0()
    {
        return $this->hasMany(AccountChartTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonAccountReports()
    {
        return $this->hasMany(AccountCommonAccountReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonAccountReports0()
    {
        return $this->hasMany(AccountCommonAccountReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonJournalReports()
    {
        return $this->hasMany(AccountCommonJournalReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonJournalReports0()
    {
        return $this->hasMany(AccountCommonJournalReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonPartnerReports()
    {
        return $this->hasMany(AccountCommonPartnerReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonPartnerReports0()
    {
        return $this->hasMany(AccountCommonPartnerReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonReports()
    {
        return $this->hasMany(AccountCommonReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonReports0()
    {
        return $this->hasMany(AccountCommonReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountConfigSettings()
    {
        return $this->hasMany(AccountConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountConfigSettings0()
    {
        return $this->hasMany(AccountConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFinancialReports()
    {
        return $this->hasMany(AccountFinancialReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFinancialReports0()
    {
        return $this->hasMany(AccountFinancialReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositions()
    {
        return $this->hasMany(AccountFiscalPosition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositions0()
    {
        return $this->hasMany(AccountFiscalPosition::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccounts()
    {
        return $this->hasMany(AccountFiscalPositionAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccounts0()
    {
        return $this->hasMany(AccountFiscalPositionAccount::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccountTemplates()
    {
        return $this->hasMany(AccountFiscalPositionAccountTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccountTemplates0()
    {
        return $this->hasMany(AccountFiscalPositionAccountTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxes()
    {
        return $this->hasMany(AccountFiscalPositionTax::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxes0()
    {
        return $this->hasMany(AccountFiscalPositionTax::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxGlobals()
    {
        return $this->hasMany(AccountFiscalPositionTaxGlobal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxGlobals0()
    {
        return $this->hasMany(AccountFiscalPositionTaxGlobal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxTemplates()
    {
        return $this->hasMany(AccountFiscalPositionTaxTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxTemplates0()
    {
        return $this->hasMany(AccountFiscalPositionTaxTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTemplates()
    {
        return $this->hasMany(AccountFiscalPositionTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTemplates0()
    {
        return $this->hasMany(AccountFiscalPositionTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyears()
    {
        return $this->hasMany(AccountFiscalyear::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyears0()
    {
        return $this->hasMany(AccountFiscalyear::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyearCloses()
    {
        return $this->hasMany(AccountFiscalyearClose::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyearCloses0()
    {
        return $this->hasMany(AccountFiscalyearClose::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyearCloseStates()
    {
        return $this->hasMany(AccountFiscalyearCloseState::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalyearCloseStates0()
    {
        return $this->hasMany(AccountFiscalyearCloseState::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGeneralJournals()
    {
        return $this->hasMany(AccountGeneralJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGeneralJournals0()
    {
        return $this->hasMany(AccountGeneralJournal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInstallers()
    {
        return $this->hasMany(AccountInstaller::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInstallers0()
    {
        return $this->hasMany(AccountInstaller::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices()
    {
        return $this->hasMany(AccountInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices0()
    {
        return $this->hasMany(AccountInvoice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices1()
    {
        return $this->hasMany(AccountInvoice::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices2()
    {
        return $this->hasMany(AccountInvoice::className(), ['approver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceCancels()
    {
        return $this->hasMany(AccountInvoiceCancel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceCancels0()
    {
        return $this->hasMany(AccountInvoiceCancel::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceConfirms()
    {
        return $this->hasMany(AccountInvoiceConfirm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceConfirms0()
    {
        return $this->hasMany(AccountInvoiceConfirm::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines0()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLineTaxAmounts()
    {
        return $this->hasMany(AccountInvoiceLineTaxAmount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLineTaxAmounts0()
    {
        return $this->hasMany(AccountInvoiceLineTaxAmount::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceRefunds()
    {
        return $this->hasMany(AccountInvoiceRefund::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceRefunds0()
    {
        return $this->hasMany(AccountInvoiceRefund::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceTaxes()
    {
        return $this->hasMany(AccountInvoiceTax::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceTaxes0()
    {
        return $this->hasMany(AccountInvoiceTax::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournals()
    {
        return $this->hasMany(AccountJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournals0()
    {
        return $this->hasMany(AccountJournal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournals1()
    {
        return $this->hasMany(AccountJournal::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalCashboxLines()
    {
        return $this->hasMany(AccountJournalCashboxLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalCashboxLines0()
    {
        return $this->hasMany(AccountJournalCashboxLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalPeriods()
    {
        return $this->hasMany(AccountJournalPeriod::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalPeriods0()
    {
        return $this->hasMany(AccountJournalPeriod::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalSelects()
    {
        return $this->hasMany(AccountJournalSelect::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournalSelects0()
    {
        return $this->hasMany(AccountJournalSelect::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModels()
    {
        return $this->hasMany(AccountModel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModels0()
    {
        return $this->hasMany(AccountModel::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModelLines()
    {
        return $this->hasMany(AccountModelLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModelLines0()
    {
        return $this->hasMany(AccountModelLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoves()
    {
        return $this->hasMany(AccountMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoves0()
    {
        return $this->hasMany(AccountMove::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveBankReconciles()
    {
        return $this->hasMany(AccountMoveBankReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveBankReconciles0()
    {
        return $this->hasMany(AccountMoveBankReconcile::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines0()
    {
        return $this->hasMany(AccountMoveLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconciles()
    {
        return $this->hasMany(AccountMoveLineReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconciles0()
    {
        return $this->hasMany(AccountMoveLineReconcile::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileSelects()
    {
        return $this->hasMany(AccountMoveLineReconcileSelect::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileSelects0()
    {
        return $this->hasMany(AccountMoveLineReconcileSelect::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileWriteoffs()
    {
        return $this->hasMany(AccountMoveLineReconcileWriteoff::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileWriteoffs0()
    {
        return $this->hasMany(AccountMoveLineReconcileWriteoff::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineUnreconcileSelects()
    {
        return $this->hasMany(AccountMoveLineUnreconcileSelect::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineUnreconcileSelects0()
    {
        return $this->hasMany(AccountMoveLineUnreconcileSelect::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveReconciles()
    {
        return $this->hasMany(AccountMoveReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveReconciles0()
    {
        return $this->hasMany(AccountMoveReconcile::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountOpenClosedFiscalyears()
    {
        return $this->hasMany(AccountOpenClosedFiscalyear::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountOpenClosedFiscalyears0()
    {
        return $this->hasMany(AccountOpenClosedFiscalyear::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerBalances()
    {
        return $this->hasMany(AccountPartnerBalance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerBalances0()
    {
        return $this->hasMany(AccountPartnerBalance::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerLedgers()
    {
        return $this->hasMany(AccountPartnerLedger::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerLedgers0()
    {
        return $this->hasMany(AccountPartnerLedger::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerReconcileProcesses()
    {
        return $this->hasMany(AccountPartnerReconcileProcess::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerReconcileProcesses0()
    {
        return $this->hasMany(AccountPartnerReconcileProcess::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTerms()
    {
        return $this->hasMany(AccountPaymentTerm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTerms0()
    {
        return $this->hasMany(AccountPaymentTerm::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTermLines()
    {
        return $this->hasMany(AccountPaymentTermLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTermLines0()
    {
        return $this->hasMany(AccountPaymentTermLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPeriods()
    {
        return $this->hasMany(AccountPeriod::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPeriods0()
    {
        return $this->hasMany(AccountPeriod::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPeriodCloses()
    {
        return $this->hasMany(AccountPeriodClose::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPeriodCloses0()
    {
        return $this->hasMany(AccountPeriodClose::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPrintJournals()
    {
        return $this->hasMany(AccountPrintJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPrintJournals0()
    {
        return $this->hasMany(AccountPrintJournal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountReportGeneralLedgers()
    {
        return $this->hasMany(AccountReportGeneralLedger::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountReportGeneralLedgers0()
    {
        return $this->hasMany(AccountReportGeneralLedger::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSequenceFiscalyears()
    {
        return $this->hasMany(AccountSequenceFiscalyear::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSequenceFiscalyears0()
    {
        return $this->hasMany(AccountSequenceFiscalyear::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStateOpens()
    {
        return $this->hasMany(AccountStateOpen::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStateOpens0()
    {
        return $this->hasMany(AccountStateOpen::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStatementFromInvoiceLines()
    {
        return $this->hasMany(AccountStatementFromInvoiceLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStatementFromInvoiceLines0()
    {
        return $this->hasMany(AccountStatementFromInvoiceLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptions()
    {
        return $this->hasMany(AccountSubscription::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptions0()
    {
        return $this->hasMany(AccountSubscription::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptionGenerates()
    {
        return $this->hasMany(AccountSubscriptionGenerate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptionGenerates0()
    {
        return $this->hasMany(AccountSubscriptionGenerate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptionLines()
    {
        return $this->hasMany(AccountSubscriptionLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountSubscriptionLines0()
    {
        return $this->hasMany(AccountSubscriptionLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxes()
    {
        return $this->hasMany(AccountTax::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxes0()
    {
        return $this->hasMany(AccountTax::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCharts()
    {
        return $this->hasMany(AccountTaxChart::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCharts0()
    {
        return $this->hasMany(AccountTaxChart::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCodes()
    {
        return $this->hasMany(AccountTaxCode::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCodes0()
    {
        return $this->hasMany(AccountTaxCode::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCodeTemplates()
    {
        return $this->hasMany(AccountTaxCodeTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxCodeTemplates0()
    {
        return $this->hasMany(AccountTaxCodeTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxTemplates()
    {
        return $this->hasMany(AccountTaxTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxTemplates0()
    {
        return $this->hasMany(AccountTaxTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUnreconciles()
    {
        return $this->hasMany(AccountUnreconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUnreconciles0()
    {
        return $this->hasMany(AccountUnreconcile::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUnreconcileReconciles()
    {
        return $this->hasMany(AccountUnreconcileReconcile::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUnreconcileReconciles0()
    {
        return $this->hasMany(AccountUnreconcileReconcile::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUseModels()
    {
        return $this->hasMany(AccountUseModel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUseModels0()
    {
        return $this->hasMany(AccountUseModel::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVatDeclarations()
    {
        return $this->hasMany(AccountVatDeclaration::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVatDeclarations0()
    {
        return $this->hasMany(AccountVatDeclaration::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVouchers()
    {
        return $this->hasMany(AccountVoucher::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVouchers0()
    {
        return $this->hasMany(AccountVoucher::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVoucherLines()
    {
        return $this->hasMany(AccountVoucherLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVoucherLines0()
    {
        return $this->hasMany(AccountVoucherLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingLegals()
    {
        return $this->hasMany(AccountingLegal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingLegals0()
    {
        return $this->hasMany(AccountingLegal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingReports()
    {
        return $this->hasMany(AccountingReport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingReports0()
    {
        return $this->hasMany(AccountingReport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionTraceabilities()
    {
        return $this->hasMany(ActionTraceability::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionTraceabilities0()
    {
        return $this->hasMany(ActionTraceability::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualAhads()
    {
        return $this->hasMany(AfterActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualAhads0()
    {
        return $this->hasMany(AfterActualAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualJumats()
    {
        return $this->hasMany(AfterActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualJumats0()
    {
        return $this->hasMany(AfterActualJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualKamis()
    {
        return $this->hasMany(AfterActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualKamis0()
    {
        return $this->hasMany(AfterActualKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualRabus()
    {
        return $this->hasMany(AfterActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualRabus0()
    {
        return $this->hasMany(AfterActualRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSabtus()
    {
        return $this->hasMany(AfterActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSabtus0()
    {
        return $this->hasMany(AfterActualSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSelasas()
    {
        return $this->hasMany(AfterActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSelasas0()
    {
        return $this->hasMany(AfterActualSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSenins()
    {
        return $this->hasMany(AfterActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSenins0()
    {
        return $this->hasMany(AfterActualSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanAhads()
    {
        return $this->hasMany(AfterPlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanAhads0()
    {
        return $this->hasMany(AfterPlanAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanJumats()
    {
        return $this->hasMany(AfterPlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanJumats0()
    {
        return $this->hasMany(AfterPlanJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanKamis()
    {
        return $this->hasMany(AfterPlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanKamis0()
    {
        return $this->hasMany(AfterPlanKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanRabus()
    {
        return $this->hasMany(AfterPlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanRabus0()
    {
        return $this->hasMany(AfterPlanRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSabtus()
    {
        return $this->hasMany(AfterPlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSabtus0()
    {
        return $this->hasMany(AfterPlanSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSelasas()
    {
        return $this->hasMany(AfterPlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSelasas0()
    {
        return $this->hasMany(AfterPlanSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSenins()
    {
        return $this->hasMany(AfterPlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSenins0()
    {
        return $this->hasMany(AfterPlanSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetDepreciationConfirmationWizards()
    {
        return $this->hasMany(AssetDepreciationConfirmationWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetDepreciationConfirmationWizards0()
    {
        return $this->hasMany(AssetDepreciationConfirmationWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetModifies()
    {
        return $this->hasMany(AssetModify::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetModifies0()
    {
        return $this->hasMany(AssetModify::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittailRulesUsers()
    {
        return $this->hasMany(AudittailRulesUsers::className(), ['rule_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(AudittrailRule::className(), ['id' => 'user_id'])->viaTable('audittail_rules_users', ['rule_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogs()
    {
        return $this->hasMany(AudittrailLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogs0()
    {
        return $this->hasMany(AudittrailLog::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogs1()
    {
        return $this->hasMany(AudittrailLog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogLines()
    {
        return $this->hasMany(AudittrailLogLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailLogLines0()
    {
        return $this->hasMany(AudittrailLogLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailRules()
    {
        return $this->hasMany(AudittrailRule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailRules0()
    {
        return $this->hasMany(AudittrailRule::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailViewLogs()
    {
        return $this->hasMany(AudittrailViewLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAudittrailViewLogs0()
    {
        return $this->hasMany(AudittrailViewLog::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRules()
    {
        return $this->hasMany(BaseActionRule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRules0()
    {
        return $this->hasMany(BaseActionRule::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRules1()
    {
        return $this->hasMany(BaseActionRule::className(), ['act_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRuleLeadTests()
    {
        return $this->hasMany(BaseActionRuleLeadTest::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRuleLeadTests0()
    {
        return $this->hasMany(BaseActionRuleLeadTest::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseActionRuleLeadTests1()
    {
        return $this->hasMany(BaseActionRuleLeadTest::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseConfigSettings()
    {
        return $this->hasMany(BaseConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseConfigSettings0()
    {
        return $this->hasMany(BaseConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseConfigSettings1()
    {
        return $this->hasMany(BaseConfigSettings::className(), ['auth_signup_template_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportImports()
    {
        return $this->hasMany(BaseImportImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportImports0()
    {
        return $this->hasMany(BaseImportImport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsChars()
    {
        return $this->hasMany(BaseImportTestsModelsChar::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsChars0()
    {
        return $this->hasMany(BaseImportTestsModelsChar::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharNoreadonlies()
    {
        return $this->hasMany(BaseImportTestsModelsCharNoreadonly::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharNoreadonlies0()
    {
        return $this->hasMany(BaseImportTestsModelsCharNoreadonly::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharReadonlies()
    {
        return $this->hasMany(BaseImportTestsModelsCharReadonly::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharReadonlies0()
    {
        return $this->hasMany(BaseImportTestsModelsCharReadonly::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharRequireds()
    {
        return $this->hasMany(BaseImportTestsModelsCharRequired::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharRequireds0()
    {
        return $this->hasMany(BaseImportTestsModelsCharRequired::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharStates()
    {
        return $this->hasMany(BaseImportTestsModelsCharStates::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharStates0()
    {
        return $this->hasMany(BaseImportTestsModelsCharStates::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharStillreadonlies()
    {
        return $this->hasMany(BaseImportTestsModelsCharStillreadonly::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsCharStillreadonlies0()
    {
        return $this->hasMany(BaseImportTestsModelsCharStillreadonly::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2os()
    {
        return $this->hasMany(BaseImportTestsModelsM2o::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2os0()
    {
        return $this->hasMany(BaseImportTestsModelsM2o::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRelateds()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRelated::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRelateds0()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRelated::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRequireds()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRequired::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRequireds0()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRequired::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRequiredRelateds()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRequiredRelated::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsM2oRequiredRelateds0()
    {
        return $this->hasMany(BaseImportTestsModelsM2oRequiredRelated::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsO2ms()
    {
        return $this->hasMany(BaseImportTestsModelsO2m::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsO2ms0()
    {
        return $this->hasMany(BaseImportTestsModelsO2m::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsO2mChildren()
    {
        return $this->hasMany(BaseImportTestsModelsO2mChild::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsO2mChildren0()
    {
        return $this->hasMany(BaseImportTestsModelsO2mChild::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsPreviews()
    {
        return $this->hasMany(BaseImportTestsModelsPreview::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseImportTestsModelsPreviews0()
    {
        return $this->hasMany(BaseImportTestsModelsPreview::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageExports()
    {
        return $this->hasMany(BaseLanguageExport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageExports0()
    {
        return $this->hasMany(BaseLanguageExport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageImports()
    {
        return $this->hasMany(BaseLanguageImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageImports0()
    {
        return $this->hasMany(BaseLanguageImport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageInstalls()
    {
        return $this->hasMany(BaseLanguageInstall::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseLanguageInstalls0()
    {
        return $this->hasMany(BaseLanguageInstall::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleConfigurations()
    {
        return $this->hasMany(BaseModuleConfiguration::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleConfigurations0()
    {
        return $this->hasMany(BaseModuleConfiguration::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleImports()
    {
        return $this->hasMany(BaseModuleImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleImports0()
    {
        return $this->hasMany(BaseModuleImport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleUpdates()
    {
        return $this->hasMany(BaseModuleUpdate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleUpdates0()
    {
        return $this->hasMany(BaseModuleUpdate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleUpgrades()
    {
        return $this->hasMany(BaseModuleUpgrade::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseModuleUpgrades0()
    {
        return $this->hasMany(BaseModuleUpgrade::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseSetupTerminologies()
    {
        return $this->hasMany(BaseSetupTerminology::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseSetupTerminologies0()
    {
        return $this->hasMany(BaseSetupTerminology::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseUpdateTranslations()
    {
        return $this->hasMany(BaseUpdateTranslations::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseUpdateTranslations0()
    {
        return $this->hasMany(BaseUpdateTranslations::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualAhads()
    {
        return $this->hasMany(BeforeActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualAhads0()
    {
        return $this->hasMany(BeforeActualAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualJumats()
    {
        return $this->hasMany(BeforeActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualJumats0()
    {
        return $this->hasMany(BeforeActualJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualKamis()
    {
        return $this->hasMany(BeforeActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualKamis0()
    {
        return $this->hasMany(BeforeActualKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualRabus()
    {
        return $this->hasMany(BeforeActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualRabus0()
    {
        return $this->hasMany(BeforeActualRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSabtus()
    {
        return $this->hasMany(BeforeActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSabtus0()
    {
        return $this->hasMany(BeforeActualSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSelasas()
    {
        return $this->hasMany(BeforeActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSelasas0()
    {
        return $this->hasMany(BeforeActualSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSenins()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSenins0()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanAhads()
    {
        return $this->hasMany(BeforePlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanAhads0()
    {
        return $this->hasMany(BeforePlanAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanJumats()
    {
        return $this->hasMany(BeforePlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanJumats0()
    {
        return $this->hasMany(BeforePlanJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanKamis()
    {
        return $this->hasMany(BeforePlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanKamis0()
    {
        return $this->hasMany(BeforePlanKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanRabus()
    {
        return $this->hasMany(BeforePlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanRabus0()
    {
        return $this->hasMany(BeforePlanRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSabtus()
    {
        return $this->hasMany(BeforePlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSabtus0()
    {
        return $this->hasMany(BeforePlanSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSelasas()
    {
        return $this->hasMany(BeforePlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSelasas0()
    {
        return $this->hasMany(BeforePlanSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSenins()
    {
        return $this->hasMany(BeforePlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSenins0()
    {
        return $this->hasMany(BeforePlanSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiayaWorkshops()
    {
        return $this->hasMany(BiayaWorkshop::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiayaWorkshops0()
    {
        return $this->hasMany(BiayaWorkshop::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoardCreates()
    {
        return $this->hasMany(BoardCreate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoardCreates0()
    {
        return $this->hasMany(BoardCreate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAlarms()
    {
        return $this->hasMany(CalendarAlarm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAlarms0()
    {
        return $this->hasMany(CalendarAlarm::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAlarms1()
    {
        return $this->hasMany(CalendarAlarm::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAttendees()
    {
        return $this->hasMany(CalendarAttendee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAttendees0()
    {
        return $this->hasMany(CalendarAttendee::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarAttendees1()
    {
        return $this->hasMany(CalendarAttendee::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarEvents()
    {
        return $this->hasMany(CalendarEvent::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarEvents0()
    {
        return $this->hasMany(CalendarEvent::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarEvents1()
    {
        return $this->hasMany(CalendarEvent::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarEvents2()
    {
        return $this->hasMany(CalendarEvent::className(), ['organizer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarTodos()
    {
        return $this->hasMany(CalendarTodo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarTodos0()
    {
        return $this->hasMany(CalendarTodo::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarTodos1()
    {
        return $this->hasMany(CalendarTodo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarTodos2()
    {
        return $this->hasMany(CalendarTodo::className(), ['organizer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashBoxIns()
    {
        return $this->hasMany(CashBoxIn::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashBoxIns0()
    {
        return $this->hasMany(CashBoxIn::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashBoxOuts()
    {
        return $this->hasMany(CashBoxOut::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashBoxOuts0()
    {
        return $this->hasMany(CashBoxOut::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines()
    {
        return $this->hasMany(CatatanLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines0()
    {
        return $this->hasMany(CatatanLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordUsers()
    {
        return $this->hasMany(ChangePasswordUser::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordUsers0()
    {
        return $this->hasMany(ChangePasswordUser::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordUsers1()
    {
        return $this->hasMany(ChangePasswordUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordWizards()
    {
        return $this->hasMany(ChangePasswordWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangePasswordWizards0()
    {
        return $this->hasMany(ChangePasswordWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeProductionQties()
    {
        return $this->hasMany(ChangeProductionQty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeProductionQties0()
    {
        return $this->hasMany(ChangeProductionQty::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetings()
    {
        return $this->hasMany(CrmMeeting::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetings0()
    {
        return $this->hasMany(CrmMeeting::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetings1()
    {
        return $this->hasMany(CrmMeeting::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetings2()
    {
        return $this->hasMany(CrmMeeting::className(), ['organizer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetingTypes()
    {
        return $this->hasMany(CrmMeetingType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmMeetingTypes0()
    {
        return $this->hasMany(CrmMeetingType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecimalPrecisions()
    {
        return $this->hasMany(DecimalPrecision::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecimalPrecisions0()
    {
        return $this->hasMany(DecimalPrecision::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCarriers()
    {
        return $this->hasMany(DeliveryCarrier::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCarriers0()
    {
        return $this->hasMany(DeliveryCarrier::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGrs()
    {
        return $this->hasMany(DeliveryGrid::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGrs0()
    {
        return $this->hasMany(DeliveryGrid::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGridLines()
    {
        return $this->hasMany(DeliveryGridLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGridLines0()
    {
        return $this->hasMany(DeliveryGridLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNotes()
    {
        return $this->hasMany(DeliveryNote::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNotes0()
    {
        return $this->hasMany(DeliveryNote::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines0()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLineReturns()
    {
        return $this->hasMany(DeliveryNoteLineReturn::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLineReturns0()
    {
        return $this->hasMany(DeliveryNoteLineReturn::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailOrderLines()
    {
        return $this->hasMany(DetailOrderLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailOrderLines0()
    {
        return $this->hasMany(DetailOrderLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs0()
    {
        return $this->hasMany(DetailPb::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDjpTaxRates()
    {
        return $this->hasMany(DjpTaxRate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDjpTaxRates0()
    {
        return $this->hasMany(DjpTaxRate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEksportImports()
    {
        return $this->hasMany(EksportImport::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEksportImports0()
    {
        return $this->hasMany(EksportImport::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplates()
    {
        return $this->hasMany(EmailTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplates0()
    {
        return $this->hasMany(EmailTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplatePreviews()
    {
        return $this->hasMany(EmailTemplatePreview::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplatePreviews0()
    {
        return $this->hasMany(EmailTemplatePreview::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFetchmailConfigSettings()
    {
        return $this->hasMany(FetchmailConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFetchmailConfigSettings0()
    {
        return $this->hasMany(FetchmailConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFetchmailServers()
    {
        return $this->hasMany(FetchmailServer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFetchmailServers0()
    {
        return $this->hasMany(FetchmailServer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSales()
    {
        return $this->hasMany(GroupSales::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSales0()
    {
        return $this->hasMany(GroupSales::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSalesLines()
    {
        return $this->hasMany(GroupSalesLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSalesLines0()
    {
        return $this->hasMany(GroupSalesLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSalesLines1()
    {
        return $this->hasMany(GroupSalesLine::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiredEmployees()
    {
        return $this->hasMany(HiredEmployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiredEmployees0()
    {
        return $this->hasMany(HiredEmployee::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryPayments()
    {
        return $this->hasMany(HistoryPayment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryPayments0()
    {
        return $this->hasMany(HistoryPayment::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicants()
    {
        return $this->hasMany(HrApplicant::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicants0()
    {
        return $this->hasMany(HrApplicant::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicants1()
    {
        return $this->hasMany(HrApplicant::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicantCategories()
    {
        return $this->hasMany(HrApplicantCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicantCategories0()
    {
        return $this->hasMany(HrApplicantCategory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceImportAttendanceLogs()
    {
        return $this->hasMany(HrAttendanceImportAttendanceLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceImportAttendanceLogs0()
    {
        return $this->hasMany(HrAttendanceImportAttendanceLog::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceLogs()
    {
        return $this->hasMany(HrAttendanceLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceLogs0()
    {
        return $this->hasMany(HrAttendanceLog::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceMachines()
    {
        return $this->hasMany(HrAttendanceMachine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceMachines0()
    {
        return $this->hasMany(HrAttendanceMachine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceManualReasons()
    {
        return $this->hasMany(HrAttendanceManualReason::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceManualReasons0()
    {
        return $this->hasMany(HrAttendanceManualReason::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceNonShiftTimetables()
    {
        return $this->hasMany(HrAttendanceNonShiftTimetable::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceNonShiftTimetables0()
    {
        return $this->hasMany(HrAttendanceNonShiftTimetable::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceTypes()
    {
        return $this->hasMany(HrAttendanceType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceTypes0()
    {
        return $this->hasMany(HrAttendanceType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrConfigSettings()
    {
        return $this->hasMany(HrConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrConfigSettings0()
    {
        return $this->hasMany(HrConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartments()
    {
        return $this->hasMany(HrDepartment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartments0()
    {
        return $this->hasMany(HrDepartment::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees()
    {
        return $this->hasMany(HrEmployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees0()
    {
        return $this->hasMany(HrEmployee::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeCategories()
    {
        return $this->hasMany(HrEmployeeCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeCategories0()
    {
        return $this->hasMany(HrEmployeeCategory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis0()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeePermissions()
    {
        return $this->hasMany(HrEmployeePermission::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeePermissions0()
    {
        return $this->hasMany(HrEmployeePermission::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationEvaluations()
    {
        return $this->hasMany(HrEvaluationEvaluation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationEvaluations0()
    {
        return $this->hasMany(HrEvaluationEvaluation::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationInterviews()
    {
        return $this->hasMany(HrEvaluationInterview::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationInterviews0()
    {
        return $this->hasMany(HrEvaluationInterview::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationPlans()
    {
        return $this->hasMany(HrEvaluationPlan::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationPlans0()
    {
        return $this->hasMany(HrEvaluationPlan::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationPlanPhases()
    {
        return $this->hasMany(HrEvaluationPlanPhase::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationPlanPhases0()
    {
        return $this->hasMany(HrEvaluationPlanPhase::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses0()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses1()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses2()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['user_valid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseLines()
    {
        return $this->hasMany(HrExpenseLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseLines0()
    {
        return $this->hasMany(HrExpenseLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidays()
    {
        return $this->hasMany(HrHolidays::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidays0()
    {
        return $this->hasMany(HrHolidays::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysStatuses()
    {
        return $this->hasMany(HrHolidaysStatus::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysStatuses0()
    {
        return $this->hasMany(HrHolidaysStatus::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysSummaryDepts()
    {
        return $this->hasMany(HrHolidaysSummaryDept::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysSummaryDepts0()
    {
        return $this->hasMany(HrHolidaysSummaryDept::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysSummaryEmployees()
    {
        return $this->hasMany(HrHolidaysSummaryEmployee::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidaysSummaryEmployees0()
    {
        return $this->hasMany(HrHolidaysSummaryEmployee::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrJobs()
    {
        return $this->hasMany(HrJob::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrJobs0()
    {
        return $this->hasMany(HrJob::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentDegrees()
    {
        return $this->hasMany(HrRecruitmentDegree::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentDegrees0()
    {
        return $this->hasMany(HrRecruitmentDegree::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentPartnerCreates()
    {
        return $this->hasMany(HrRecruitmentPartnerCreate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentPartnerCreates0()
    {
        return $this->hasMany(HrRecruitmentPartnerCreate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentSources()
    {
        return $this->hasMany(HrRecruitmentSource::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentSources0()
    {
        return $this->hasMany(HrRecruitmentSource::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentStages()
    {
        return $this->hasMany(HrRecruitmentStage::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentStages0()
    {
        return $this->hasMany(HrRecruitmentStage::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoves()
    {
        return $this->hasMany(InternalMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoves0()
    {
        return $this->hasMany(InternalMove::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLines()
    {
        return $this->hasMany(InternalMoveLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLines0()
    {
        return $this->hasMany(InternalMoveLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLineDetails()
    {
        return $this->hasMany(InternalMoveLineDetail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLineDetails0()
    {
        return $this->hasMany(InternalMoveLineDetail::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequests()
    {
        return $this->hasMany(InternalMoveRequest::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequests0()
    {
        return $this->hasMany(InternalMoveRequest::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequests1()
    {
        return $this->hasMany(InternalMoveRequest::className(), ['request_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequestLines()
    {
        return $this->hasMany(InternalMoveRequestLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequestLines0()
    {
        return $this->hasMany(InternalMoveRequestLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActWindowViews()
    {
        return $this->hasMany(IrActWindowView::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActWindowViews0()
    {
        return $this->hasMany(IrActWindowView::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActions()
    {
        return $this->hasMany(IrActions::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActions0()
    {
        return $this->hasMany(IrActions::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActionsConfigurationWizards()
    {
        return $this->hasMany(IrActionsConfigurationWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActionsConfigurationWizards0()
    {
        return $this->hasMany(IrActionsConfigurationWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActionsTodos()
    {
        return $this->hasMany(IrActionsTodo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActionsTodos0()
    {
        return $this->hasMany(IrActionsTodo::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrAttachments()
    {
        return $this->hasMany(IrAttachment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrAttachments0()
    {
        return $this->hasMany(IrAttachment::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrConfigParameters()
    {
        return $this->hasMany(IrConfigParameter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrConfigParameters0()
    {
        return $this->hasMany(IrConfigParameter::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrCrons()
    {
        return $this->hasMany(IrCron::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrCrons0()
    {
        return $this->hasMany(IrCron::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrCrons1()
    {
        return $this->hasMany(IrCron::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrDefaults()
    {
        return $this->hasMany(IrDefault::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrDefaults0()
    {
        return $this->hasMany(IrDefault::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrDefaults1()
    {
        return $this->hasMany(IrDefault::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrExports()
    {
        return $this->hasMany(IrExports::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrExports0()
    {
        return $this->hasMany(IrExports::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrExportsLines()
    {
        return $this->hasMany(IrExportsLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrExportsLines0()
    {
        return $this->hasMany(IrExportsLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFieldsConverters()
    {
        return $this->hasMany(IrFieldsConverter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFieldsConverters0()
    {
        return $this->hasMany(IrFieldsConverter::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFilters()
    {
        return $this->hasMany(IrFilters::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFilters0()
    {
        return $this->hasMany(IrFilters::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrFilters1()
    {
        return $this->hasMany(IrFilters::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrHeaderImgs()
    {
        return $this->hasMany(IrHeaderImg::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrHeaderImgs0()
    {
        return $this->hasMany(IrHeaderImg::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrHeaderWebkits()
    {
        return $this->hasMany(IrHeaderWebkit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrHeaderWebkits0()
    {
        return $this->hasMany(IrHeaderWebkit::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrMailServers()
    {
        return $this->hasMany(IrMailServer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrMailServers0()
    {
        return $this->hasMany(IrMailServer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModels()
    {
        return $this->hasMany(IrModel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModels0()
    {
        return $this->hasMany(IrModel::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelAccesses()
    {
        return $this->hasMany(IrModelAccess::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelAccesses0()
    {
        return $this->hasMany(IrModelAccess::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelFields()
    {
        return $this->hasMany(IrModelFields::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelFields0()
    {
        return $this->hasMany(IrModelFields::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleCategories()
    {
        return $this->hasMany(IrModuleCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleCategories0()
    {
        return $this->hasMany(IrModuleCategory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleModules()
    {
        return $this->hasMany(IrModuleModule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleModules0()
    {
        return $this->hasMany(IrModuleModule::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleModuleDependencies()
    {
        return $this->hasMany(IrModuleModuleDependency::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModuleModuleDependencies0()
    {
        return $this->hasMany(IrModuleModuleDependency::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrProperties()
    {
        return $this->hasMany(IrProperty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrProperties0()
    {
        return $this->hasMany(IrProperty::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrRules()
    {
        return $this->hasMany(IrRule::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrRules0()
    {
        return $this->hasMany(IrRule::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrSequences()
    {
        return $this->hasMany(IrSequence::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrSequences0()
    {
        return $this->hasMany(IrSequence::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrSequenceTypes()
    {
        return $this->hasMany(IrSequenceType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrSequenceTypes0()
    {
        return $this->hasMany(IrSequenceType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrServerObjectLines()
    {
        return $this->hasMany(IrServerObjectLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrServerObjectLines0()
    {
        return $this->hasMany(IrServerObjectLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiMenus()
    {
        return $this->hasMany(IrUiMenu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiMenus0()
    {
        return $this->hasMany(IrUiMenu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViews()
    {
        return $this->hasMany(IrUiView::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViews0()
    {
        return $this->hasMany(IrUiView::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewCustoms()
    {
        return $this->hasMany(IrUiViewCustom::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewCustoms0()
    {
        return $this->hasMany(IrUiViewCustom::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewCustoms1()
    {
        return $this->hasMany(IrUiViewCustom::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewScs()
    {
        return $this->hasMany(IrUiViewSc::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewScs0()
    {
        return $this->hasMany(IrUiViewSc::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewScs1()
    {
        return $this->hasMany(IrUiViewSc::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrValues()
    {
        return $this->hasMany(IrValues::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrValues0()
    {
        return $this->hasMany(IrValues::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrValues1()
    {
        return $this->hasMany(IrValues::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogActivities()
    {
        return $this->hasMany(LogActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogActivities0()
    {
        return $this->hasMany(LogActivity::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogActivities1()
    {
        return $this->hasMany(LogActivity::className(), ['salesman_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogStatusCustomers()
    {
        return $this->hasMany(LogStatusCustomer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogStatusCustomers0()
    {
        return $this->hasMany(LogStatusCustomer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogStatusCustomers1()
    {
        return $this->hasMany(LogStatusCustomer::className(), ['salesman_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailAliases()
    {
        return $this->hasMany(MailAlias::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailAliases0()
    {
        return $this->hasMany(MailAlias::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailAliases1()
    {
        return $this->hasMany(MailAlias::className(), ['alias_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailComposeMessages()
    {
        return $this->hasMany(MailComposeMessage::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailComposeMessages0()
    {
        return $this->hasMany(MailComposeMessage::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailGroups()
    {
        return $this->hasMany(MailGroup::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailGroups0()
    {
        return $this->hasMany(MailGroup::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMails()
    {
        return $this->hasMany(MailMail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMails0()
    {
        return $this->hasMany(MailMail::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessages()
    {
        return $this->hasMany(MailMessage::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessages0()
    {
        return $this->hasMany(MailMessage::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessageSubtypes()
    {
        return $this->hasMany(MailMessageSubtype::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailMessageSubtypes0()
    {
        return $this->hasMany(MailMessageSubtype::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailVotes()
    {
        return $this->hasMany(MailVote::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(MailMessage::className(), ['id' => 'message_id'])->viaTable('mail_vote', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailWizardInvites()
    {
        return $this->hasMany(MailWizardInvite::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailWizardInvites0()
    {
        return $this->hasMany(MailWizardInvite::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeProcurements()
    {
        return $this->hasMany(MakeProcurement::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeProcurements0()
    {
        return $this->hasMany(MakeProcurement::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagementSummaries()
    {
        return $this->hasMany(ManagementSummary::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagementSummaries0()
    {
        return $this->hasMany(ManagementSummary::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagementSummaries1()
    {
        return $this->hasMany(ManagementSummary::className(), ['salesman_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManyVouchers()
    {
        return $this->hasMany(ManyVoucher::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManyVouchers0()
    {
        return $this->hasMany(ManyVoucher::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMergePickings()
    {
        return $this->hasMany(MergePickings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMergePickings0()
    {
        return $this->hasMany(MergePickings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas()
    {
        return $this->hasMany(MoveSetData::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas0()
    {
        return $this->hasMany(MoveSetData::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBoms()
    {
        return $this->hasMany(MrpBom::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBoms0()
    {
        return $this->hasMany(MrpBom::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpConfigSettings()
    {
        return $this->hasMany(MrpConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpConfigSettings0()
    {
        return $this->hasMany(MrpConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductPrices()
    {
        return $this->hasMany(MrpProductPrice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductPrices0()
    {
        return $this->hasMany(MrpProductPrice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductProduces()
    {
        return $this->hasMany(MrpProductProduce::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductProduces0()
    {
        return $this->hasMany(MrpProductProduce::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions0()
    {
        return $this->hasMany(MrpProduction::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions1()
    {
        return $this->hasMany(MrpProduction::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionProductLines()
    {
        return $this->hasMany(MrpProductionProductLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionProductLines0()
    {
        return $this->hasMany(MrpProductionProductLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionWorkcenterLines()
    {
        return $this->hasMany(MrpProductionWorkcenterLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionWorkcenterLines0()
    {
        return $this->hasMany(MrpProductionWorkcenterLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProperties()
    {
        return $this->hasMany(MrpProperty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProperties0()
    {
        return $this->hasMany(MrpProperty::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpPropertyGroups()
    {
        return $this->hasMany(MrpPropertyGroup::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpPropertyGroups0()
    {
        return $this->hasMany(MrpPropertyGroup::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutings()
    {
        return $this->hasMany(MrpRouting::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutings0()
    {
        return $this->hasMany(MrpRouting::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutingWorkcenters()
    {
        return $this->hasMany(MrpRoutingWorkcenter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutingWorkcenters0()
    {
        return $this->hasMany(MrpRoutingWorkcenter::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenters()
    {
        return $this->hasMany(MrpWorkcenter::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenters0()
    {
        return $this->hasMany(MrpWorkcenter::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenterLoads()
    {
        return $this->hasMany(MrpWorkcenterLoad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenterLoads0()
    {
        return $this->hasMany(MrpWorkcenterLoad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultiCompanyDefaults()
    {
        return $this->hasMany(MultiCompanyDefault::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultiCompanyDefaults0()
    {
        return $this->hasMany(MultiCompanyDefault::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiAccounts()
    {
        return $this->hasMany(MutasiAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiAccounts0()
    {
        return $this->hasMany(MutasiAccount::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiStocks()
    {
        return $this->hasMany(MutasiStock::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiStocks0()
    {
        return $this->hasMany(MutasiStock::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparations()
    {
        return $this->hasMany(OrderPreparation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparations0()
    {
        return $this->hasMany(OrderPreparation::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationBatches()
    {
        return $this->hasMany(OrderPreparationBatch::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationBatches0()
    {
        return $this->hasMany(OrderPreparationBatch::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines0()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveries()
    {
        return $this->hasMany(OrderRequisitionDelivery::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveries0()
    {
        return $this->hasMany(OrderRequisitionDelivery::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveries1()
    {
        return $this->hasMany(OrderRequisitionDelivery::className(), ['received_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveries2()
    {
        return $this->hasMany(OrderRequisitionDelivery::className(), ['confirmed_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveries3()
    {
        return $this->hasMany(OrderRequisitionDelivery::className(), ['prepare_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveries4()
    {
        return $this->hasMany(OrderRequisitionDelivery::className(), ['approved_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveryLines()
    {
        return $this->hasMany(OrderRequisitionDeliveryLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveryLines0()
    {
        return $this->hasMany(OrderRequisitionDeliveryLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveryLinePos()
    {
        return $this->hasMany(OrderRequisitionDeliveryLinePo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRequisitionDeliveryLinePos0()
    {
        return $this->hasMany(OrderRequisitionDeliveryLinePo::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsvMemoryAutovacuums()
    {
        return $this->hasMany(OsvMemoryAutovacuum::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsvMemoryAutovacuums0()
    {
        return $this->hasMany(OsvMemoryAutovacuum::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackingListLines()
    {
        return $this->hasMany(PackingListLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackingListLines0()
    {
        return $this->hasMany(PackingListLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelianBarangs()
    {
        return $this->hasMany(PembelianBarang::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelianBarangs0()
    {
        return $this->hasMany(PembelianBarang::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas()
    {
        return $this->hasMany(PerintahKerja::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas0()
    {
        return $this->hasMany(PerintahKerja::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas1()
    {
        return $this->hasMany(PerintahKerja::className(), ['creator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas2()
    {
        return $this->hasMany(PerintahKerja::className(), ['approver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjas3()
    {
        return $this->hasMany(PerintahKerja::className(), ['checker' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals0()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals1()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['approver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals2()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['creator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals3()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['checker' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines0()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLineInternals()
    {
        return $this->hasMany(PerintahKerjaLineInternal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLineInternals0()
    {
        return $this->hasMany(PerintahKerjaLineInternal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts0()
    {
        return $this->hasMany(Port::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalPaymentAcquirers()
    {
        return $this->hasMany(PortalPaymentAcquirer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalPaymentAcquirers0()
    {
        return $this->hasMany(PortalPaymentAcquirer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizards()
    {
        return $this->hasMany(PortalWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizards0()
    {
        return $this->hasMany(PortalWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizardUsers()
    {
        return $this->hasMany(PortalWizardUser::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizardUsers0()
    {
        return $this->hasMany(PortalWizardUser::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrs()
    {
        return $this->hasMany(Pr::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrs0()
    {
        return $this->hasMany(Pr::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrs1()
    {
        return $this->hasMany(Pr::className(), ['salesman_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricelistPartnerinfos()
    {
        return $this->hasMany(PricelistPartnerinfo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricelistPartnerinfos0()
    {
        return $this->hasMany(PricelistPartnerinfo::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessConditions()
    {
        return $this->hasMany(ProcessCondition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessConditions0()
    {
        return $this->hasMany(ProcessCondition::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessNodes()
    {
        return $this->hasMany(ProcessNode::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessNodes0()
    {
        return $this->hasMany(ProcessNode::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessProcesses()
    {
        return $this->hasMany(ProcessProcess::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessProcesses0()
    {
        return $this->hasMany(ProcessProcess::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitions()
    {
        return $this->hasMany(ProcessTransition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitions0()
    {
        return $this->hasMany(ProcessTransition::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitionActions()
    {
        return $this->hasMany(ProcessTransitionAction::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitionActions0()
    {
        return $this->hasMany(ProcessTransitionAction::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders0()
    {
        return $this->hasMany(ProcurementOrder::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderComputes()
    {
        return $this->hasMany(ProcurementOrderCompute::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderComputes0()
    {
        return $this->hasMany(ProcurementOrderCompute::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderComputeAlls()
    {
        return $this->hasMany(ProcurementOrderComputeAll::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderComputeAlls0()
    {
        return $this->hasMany(ProcurementOrderComputeAll::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderpointComputes()
    {
        return $this->hasMany(ProcurementOrderpointCompute::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrderpointComputes0()
    {
        return $this->hasMany(ProcurementOrderpointCompute::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatchLines()
    {
        return $this->hasMany(ProductBatchLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatchLines0()
    {
        return $this->hasMany(ProductBatchLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories0()
    {
        return $this->hasMany(ProductCategory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductListLines()
    {
        return $this->hasMany(ProductListLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductListLines0()
    {
        return $this->hasMany(ProductListLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackagings()
    {
        return $this->hasMany(ProductPackaging::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackagings0()
    {
        return $this->hasMany(ProductPackaging::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPriceTypes()
    {
        return $this->hasMany(ProductPriceType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPriceTypes0()
    {
        return $this->hasMany(ProductPriceType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelists()
    {
        return $this->hasMany(ProductPricelist::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelists0()
    {
        return $this->hasMany(ProductPricelist::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistItems()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistItems0()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistTypes()
    {
        return $this->hasMany(ProductPricelistType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistTypes0()
    {
        return $this->hasMany(ProductPricelistType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistVersions()
    {
        return $this->hasMany(ProductPricelistVersion::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistVersions0()
    {
        return $this->hasMany(ProductPricelistVersion::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProducts()
    {
        return $this->hasMany(ProductProduct::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProducts0()
    {
        return $this->hasMany(ProductProduct::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierinfos()
    {
        return $this->hasMany(ProductSupplierinfo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierinfos0()
    {
        return $this->hasMany(ProductSupplierinfo::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTemplates()
    {
        return $this->hasMany(ProductTemplate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTemplates0()
    {
        return $this->hasMany(ProductTemplate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTemplates1()
    {
        return $this->hasMany(ProductTemplate::className(), ['product_manager' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUls()
    {
        return $this->hasMany(ProductUl::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUls0()
    {
        return $this->hasMany(ProductUl::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUoms()
    {
        return $this->hasMany(ProductUom::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUoms0()
    {
        return $this->hasMany(ProductUom::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUomCategs()
    {
        return $this->hasMany(ProductUomCateg::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUomCategs0()
    {
        return $this->hasMany(ProductUomCateg::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariants::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariants0()
    {
        return $this->hasMany(ProductVariants::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAccountAnalyticLines()
    {
        return $this->hasMany(ProjectAccountAnalyticLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAccountAnalyticLines0()
    {
        return $this->hasMany(ProjectAccountAnalyticLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisherWarrantyContracts()
    {
        return $this->hasMany(PublisherWarrantyContract::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisherWarrantyContracts0()
    {
        return $this->hasMany(PublisherWarrantyContract::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseConfigSettings()
    {
        return $this->hasMany(PurchaseConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseConfigSettings0()
    {
        return $this->hasMany(PurchaseConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders0()
    {
        return $this->hasMany(PurchaseOrder::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders1()
    {
        return $this->hasMany(PurchaseOrder::className(), ['validator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderGroups()
    {
        return $this->hasMany(PurchaseOrderGroup::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderGroups0()
    {
        return $this->hasMany(PurchaseOrderGroup::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines0()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineCancels()
    {
        return $this->hasMany(PurchaseOrderLineCancel::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineCancels0()
    {
        return $this->hasMany(PurchaseOrderLineCancel::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineCancels1()
    {
        return $this->hasMany(PurchaseOrderLineCancel::className(), ['approved_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineFromRequisitionLines()
    {
        return $this->hasMany(PurchaseOrderLineFromRequisitionLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineFromRequisitionLines0()
    {
        return $this->hasMany(PurchaseOrderLineFromRequisitionLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineInvoices()
    {
        return $this->hasMany(PurchaseOrderLineInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineInvoices0()
    {
        return $this->hasMany(PurchaseOrderLineInvoice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderRevisions()
    {
        return $this->hasMany(PurchaseOrderRevision::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderRevisions0()
    {
        return $this->hasMany(PurchaseOrderRevision::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines0()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePartialInvoices()
    {
        return $this->hasMany(PurchasePartialInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchasePartialInvoices0()
    {
        return $this->hasMany(PurchasePartialInvoice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubconts()
    {
        return $this->hasMany(PurchaseRequisitionSubcont::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubconts0()
    {
        return $this->hasMany(PurchaseRequisitionSubcont::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubconts1()
    {
        return $this->hasMany(PurchaseRequisitionSubcont::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines0()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLineToSends()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLineToSend::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLineToSends0()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLineToSend::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontSendLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontSendLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontSendLines0()
    {
        return $this->hasMany(PurchaseRequisitionSubcontSendLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines()
    {
        return $this->hasMany(RawMaterialLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines0()
    {
        return $this->hasMany(RawMaterialLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen()
    {
        return $this->hasMany(RemainderSalesman::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen0()
    {
        return $this->hasMany(RemainderSalesman::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen1()
    {
        return $this->hasMany(RemainderSalesman::className(), ['salesman_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitions()
    {
        return $this->hasMany(RentRequisition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitions0()
    {
        return $this->hasMany(RentRequisition::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitionDetails()
    {
        return $this->hasMany(RentRequisitionDetail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitionDetails0()
    {
        return $this->hasMany(RentRequisitionDetail::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportSaldoAkhirs()
    {
        return $this->hasMany(ReportSaldoAkhir::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportSaldoAkhirs0()
    {
        return $this->hasMany(ReportSaldoAkhir::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportTransaksiAccounts()
    {
        return $this->hasMany(ReportTransaksiAccount::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportTransaksiAccounts0()
    {
        return $this->hasMany(ReportTransaksiAccount::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportWebkitActions()
    {
        return $this->hasMany(ReportWebkitActions::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportWebkitActions0()
    {
        return $this->hasMany(ReportWebkitActions::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResAlarms()
    {
        return $this->hasMany(ResAlarm::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResAlarms0()
    {
        return $this->hasMany(ResAlarm::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResBanks()
    {
        return $this->hasMany(ResBank::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResBanks0()
    {
        return $this->hasMany(ResBank::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanies()
    {
        return $this->hasMany(ResCompany::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanies0()
    {
        return $this->hasMany(ResCompany::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanyUsersRels()
    {
        return $this->hasMany(ResCompanyUsersRel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCs()
    {
        return $this->hasMany(ResCompany::className(), ['id' => 'cid'])->viaTable('res_company_users_rel', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigs()
    {
        return $this->hasMany(ResConfig::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigs0()
    {
        return $this->hasMany(ResConfig::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigInstallers()
    {
        return $this->hasMany(ResConfigInstaller::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigInstallers0()
    {
        return $this->hasMany(ResConfigInstaller::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigSettings()
    {
        return $this->hasMany(ResConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResConfigSettings0()
    {
        return $this->hasMany(ResConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountries()
    {
        return $this->hasMany(ResCountry::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountries0()
    {
        return $this->hasMany(ResCountry::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountryStates()
    {
        return $this->hasMany(ResCountryState::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountryStates0()
    {
        return $this->hasMany(ResCountryState::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencies()
    {
        return $this->hasMany(ResCurrency::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencies0()
    {
        return $this->hasMany(ResCurrency::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRates()
    {
        return $this->hasMany(ResCurrencyRate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRates0()
    {
        return $this->hasMany(ResCurrencyRate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRateTypes()
    {
        return $this->hasMany(ResCurrencyRateType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRateTypes0()
    {
        return $this->hasMany(ResCurrencyRateType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroups()
    {
        return $this->hasMany(ResGroups::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroups0()
    {
        return $this->hasMany(ResGroups::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsUsersRels()
    {
        return $this->hasMany(ResGroupsUsersRel::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGs()
    {
        return $this->hasMany(ResGroups::className(), ['id' => 'gid'])->viaTable('res_groups_users_rel', ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResLangs()
    {
        return $this->hasMany(ResLang::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResLangs0()
    {
        return $this->hasMany(ResLang::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartners()
    {
        return $this->hasMany(ResPartner::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartners0()
    {
        return $this->hasMany(ResPartner::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartners1()
    {
        return $this->hasMany(ResPartner::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBanks()
    {
        return $this->hasMany(ResPartnerBank::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBanks0()
    {
        return $this->hasMany(ResPartnerBank::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBankTypes()
    {
        return $this->hasMany(ResPartnerBankType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBankTypes0()
    {
        return $this->hasMany(ResPartnerBankType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBankTypeFields()
    {
        return $this->hasMany(ResPartnerBankTypeField::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBankTypeFields0()
    {
        return $this->hasMany(ResPartnerBankTypeField::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerCategories()
    {
        return $this->hasMany(ResPartnerCategory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerCategories0()
    {
        return $this->hasMany(ResPartnerCategory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerTitles()
    {
        return $this->hasMany(ResPartnerTitle::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerTitles0()
    {
        return $this->hasMany(ResPartnerTitle::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequests()
    {
        return $this->hasMany(ResRequest::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequests0()
    {
        return $this->hasMany(ResRequest::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequests1()
    {
        return $this->hasMany(ResRequest::className(), ['act_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequests2()
    {
        return $this->hasMany(ResRequest::className(), ['act_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestHistories()
    {
        return $this->hasMany(ResRequestHistory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestHistories0()
    {
        return $this->hasMany(ResRequestHistory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestHistories1()
    {
        return $this->hasMany(ResRequestHistory::className(), ['act_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestHistories2()
    {
        return $this->hasMany(ResRequestHistory::className(), ['act_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestLinks()
    {
        return $this->hasMany(ResRequestLink::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResRequestLinks0()
    {
        return $this->hasMany(ResRequestLink::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelompok()
    {
        return $this->hasOne(GroupSales::className(), ['id' => 'kelompok_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlias()
    {
        return $this->hasOne(MailAlias::className(), ['id' => 'alias_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResUsers()
    {
        return $this->hasMany(ResUsers::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResUsers0()
    {
        return $this->hasMany(ResUsers::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResetStatuses()
    {
        return $this->hasMany(ResetStatus::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResetStatuses0()
    {
        return $this->hasMany(ResetStatus::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendars()
    {
        return $this->hasMany(ResourceCalendar::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendars0()
    {
        return $this->hasMany(ResourceCalendar::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendars1()
    {
        return $this->hasMany(ResourceCalendar::className(), ['manager' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendarAttendances()
    {
        return $this->hasMany(ResourceCalendarAttendance::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendarAttendances0()
    {
        return $this->hasMany(ResourceCalendarAttendance::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendarLeaves()
    {
        return $this->hasMany(ResourceCalendarLeaves::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceCalendarLeaves0()
    {
        return $this->hasMany(ResourceCalendarLeaves::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceResources()
    {
        return $this->hasMany(ResourceResource::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceResources0()
    {
        return $this->hasMany(ResourceResource::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceResources1()
    {
        return $this->hasMany(ResourceResource::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleAdvancePaymentInvs()
    {
        return $this->hasMany(SaleAdvancePaymentInv::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleAdvancePaymentInvs0()
    {
        return $this->hasMany(SaleAdvancePaymentInv::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleConfigSettings()
    {
        return $this->hasMany(SaleConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleConfigSettings0()
    {
        return $this->hasMany(SaleConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleMakeInvoices()
    {
        return $this->hasMany(SaleMakeInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleMakeInvoices0()
    {
        return $this->hasMany(SaleMakeInvoice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders()
    {
        return $this->hasMany(SaleOrder::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders0()
    {
        return $this->hasMany(SaleOrder::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders1()
    {
        return $this->hasMany(SaleOrder::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines0()
    {
        return $this->hasMany(SaleOrderLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines1()
    {
        return $this->hasMany(SaleOrderLine::className(), ['salesman_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineFromRequisitionLines()
    {
        return $this->hasMany(SaleOrderLineFromRequisitionLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineFromRequisitionLines0()
    {
        return $this->hasMany(SaleOrderLineFromRequisitionLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineMakeInvoices()
    {
        return $this->hasMany(SaleOrderLineMakeInvoice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineMakeInvoices0()
    {
        return $this->hasMany(SaleOrderLineMakeInvoice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderSummaries()
    {
        return $this->hasMany(SaleOrderSummary::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderSummaries0()
    {
        return $this->hasMany(SaleOrderSummary::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleShops()
    {
        return $this->hasMany(SaleShop::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleShops0()
    {
        return $this->hasMany(SaleShop::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesActivities()
    {
        return $this->hasMany(SalesActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesActivities0()
    {
        return $this->hasMany(SalesActivity::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesActivities1()
    {
        return $this->hasMany(SalesActivity::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesManTargets()
    {
        return $this->hasMany(SalesManTarget::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesManTargets0()
    {
        return $this->hasMany(SalesManTarget::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesManTargets1()
    {
        return $this->hasMany(SalesManTarget::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkCustomers()
    {
        return $this->hasMany(ScopeWorkCustomer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkCustomers0()
    {
        return $this->hasMany(ScopeWorkCustomer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkSupras()
    {
        return $this->hasMany(ScopeWorkSupra::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopeWorkSupras0()
    {
        return $this->hasMany(ScopeWorkSupra::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetPos()
    {
        return $this->hasMany(SetPo::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetPos0()
    {
        return $this->hasMany(SetPo::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizards()
    {
        return $this->hasMany(ShareWizard::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizards0()
    {
        return $this->hasMany(ShareWizard::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResUserRels()
    {
        return $this->hasMany(ShareWizardResUserRel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(ShareWizard::className(), ['id' => 'share_id'])->viaTable('share_wizard_res_user_rel', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResultLines()
    {
        return $this->hasMany(ShareWizardResultLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResultLines0()
    {
        return $this->hasMany(ShareWizardResultLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResultLines1()
    {
        return $this->hasMany(ShareWizardResultLine::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusSublines()
    {
        return $this->hasMany(StatusSubline::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusSublines0()
    {
        return $this->hasMany(StatusSubline::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties0()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeStandardPrices()
    {
        return $this->hasMany(StockChangeStandardPrice::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeStandardPrices0()
    {
        return $this->hasMany(StockChangeStandardPrice::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockConfigSettings()
    {
        return $this->hasMany(StockConfigSettings::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockConfigSettings0()
    {
        return $this->hasMany(StockConfigSettings::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockFillInventories()
    {
        return $this->hasMany(StockFillInventory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockFillInventories0()
    {
        return $this->hasMany(StockFillInventory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockIncoterms()
    {
        return $this->hasMany(StockIncoterms::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockIncoterms0()
    {
        return $this->hasMany(StockIncoterms::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventories()
    {
        return $this->hasMany(StockInventory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventories0()
    {
        return $this->hasMany(StockInventory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines0()
    {
        return $this->hasMany(StockInventoryLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits0()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplitLines()
    {
        return $this->hasMany(StockInventoryLineSplitLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplitLines0()
    {
        return $this->hasMany(StockInventoryLineSplitLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryMerges()
    {
        return $this->hasMany(StockInventoryMerge::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryMerges0()
    {
        return $this->hasMany(StockInventoryMerge::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInvoiceOnshippings()
    {
        return $this->hasMany(StockInvoiceOnshipping::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInvoiceOnshippings0()
    {
        return $this->hasMany(StockInvoiceOnshipping::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockJournals()
    {
        return $this->hasMany(StockJournal::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockJournals0()
    {
        return $this->hasMany(StockJournal::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockJournals1()
    {
        return $this->hasMany(StockJournal::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocations()
    {
        return $this->hasMany(StockLocation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocations0()
    {
        return $this->hasMany(StockLocation::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocationProducts()
    {
        return $this->hasMany(StockLocationProduct::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocationProducts0()
    {
        return $this->hasMany(StockLocationProduct::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves0()
    {
        return $this->hasMany(StockMove::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes()
    {
        return $this->hasMany(StockMoveConsume::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes0()
    {
        return $this->hasMany(StockMoveConsume::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps()
    {
        return $this->hasMany(StockMoveScrap::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps0()
    {
        return $this->hasMany(StockMoveScrap::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits()
    {
        return $this->hasMany(StockMoveSplit::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits0()
    {
        return $this->hasMany(StockMoveSplit::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplitLines()
    {
        return $this->hasMany(StockMoveSplitLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplitLines0()
    {
        return $this->hasMany(StockMoveSplitLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoves()
    {
        return $this->hasMany(StockPartialMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoves0()
    {
        return $this->hasMany(StockPartialMove::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines0()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickings()
    {
        return $this->hasMany(StockPartialPicking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickings0()
    {
        return $this->hasMany(StockPartialPicking::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines0()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings0()
    {
        return $this->hasMany(StockPicking::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLots()
    {
        return $this->hasMany(StockProductionLot::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLots0()
    {
        return $this->hasMany(StockProductionLot::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLotRevisions()
    {
        return $this->hasMany(StockProductionLotRevision::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLotRevisions0()
    {
        return $this->hasMany(StockProductionLotRevision::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLotRevisions1()
    {
        return $this->hasMany(StockProductionLotRevision::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickings()
    {
        return $this->hasMany(StockReturnPicking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickings0()
    {
        return $this->hasMany(StockReturnPicking::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickingMemories()
    {
        return $this->hasMany(StockReturnPickingMemory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickingMemories0()
    {
        return $this->hasMany(StockReturnPickingMemory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitIntos()
    {
        return $this->hasMany(StockSplitInto::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitIntos0()
    {
        return $this->hasMany(StockSplitInto::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockTrackings()
    {
        return $this->hasMany(StockTracking::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockTrackings0()
    {
        return $this->hasMany(StockTracking::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouses()
    {
        return $this->hasMany(StockWarehouse::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouses0()
    {
        return $this->hasMany(StockWarehouse::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints0()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperNotes()
    {
        return $this->hasMany(SuperNotes::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperNotes0()
    {
        return $this->hasMany(SuperNotes::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveys()
    {
        return $this->hasMany(Survey::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveys0()
    {
        return $this->hasMany(Survey::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveys1()
    {
        return $this->hasMany(Survey::className(), ['responsible_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyAnswers()
    {
        return $this->hasMany(SurveyAnswer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyAnswers0()
    {
        return $this->hasMany(SurveyAnswer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyBrowseAnswers()
    {
        return $this->hasMany(SurveyBrowseAnswer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyBrowseAnswers0()
    {
        return $this->hasMany(SurveyBrowseAnswer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyHistories()
    {
        return $this->hasMany(SurveyHistory::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyHistories0()
    {
        return $this->hasMany(SurveyHistory::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyHistories1()
    {
        return $this->hasMany(SurveyHistory::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyInvitedUserRels()
    {
        return $this->hasMany(SurveyInvitedUserRel::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return $this->hasMany(Survey::className(), ['id' => 'sid'])->viaTable('survey_invited_user_rel', ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyNameWizs()
    {
        return $this->hasMany(SurveyNameWiz::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyNameWizs0()
    {
        return $this->hasMany(SurveyNameWiz::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPages()
    {
        return $this->hasMany(SurveyPage::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPages0()
    {
        return $this->hasMany(SurveyPage::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPrints()
    {
        return $this->hasMany(SurveyPrint::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPrints0()
    {
        return $this->hasMany(SurveyPrint::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPrintAnswers()
    {
        return $this->hasMany(SurveyPrintAnswer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPrintAnswers0()
    {
        return $this->hasMany(SurveyPrintAnswer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPrintStatistics()
    {
        return $this->hasMany(SurveyPrintStatistics::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyPrintStatistics0()
    {
        return $this->hasMany(SurveyPrintStatistics::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyQuestions()
    {
        return $this->hasMany(SurveyQuestion::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyQuestions0()
    {
        return $this->hasMany(SurveyQuestion::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyQuestionColumnHeadings()
    {
        return $this->hasMany(SurveyQuestionColumnHeading::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyQuestionColumnHeadings0()
    {
        return $this->hasMany(SurveyQuestionColumnHeading::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyQuestionWizs()
    {
        return $this->hasMany(SurveyQuestionWiz::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyQuestionWizs0()
    {
        return $this->hasMany(SurveyQuestionWiz::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyRequests()
    {
        return $this->hasMany(SurveyRequest::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyRequests0()
    {
        return $this->hasMany(SurveyRequest::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyRequests1()
    {
        return $this->hasMany(SurveyRequest::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponses()
    {
        return $this->hasMany(SurveyResponse::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponses0()
    {
        return $this->hasMany(SurveyResponse::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponses1()
    {
        return $this->hasMany(SurveyResponse::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponseAnswers()
    {
        return $this->hasMany(SurveyResponseAnswer::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponseAnswers0()
    {
        return $this->hasMany(SurveyResponseAnswer::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponseLines()
    {
        return $this->hasMany(SurveyResponseLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResponseLines0()
    {
        return $this->hasMany(SurveyResponseLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveySendInvitations()
    {
        return $this->hasMany(SurveySendInvitation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveySendInvitations0()
    {
        return $this->hasMany(SurveySendInvitation::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveySendInvitationLogs()
    {
        return $this->hasMany(SurveySendInvitationLog::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveySendInvitationLogs0()
    {
        return $this->hasMany(SurveySendInvitationLog::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyTblColumnHeadings()
    {
        return $this->hasMany(SurveyTblColumnHeading::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyTblColumnHeadings0()
    {
        return $this->hasMany(SurveyTblColumnHeading::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyTypes()
    {
        return $this->hasMany(SurveyType::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyTypes0()
    {
        return $this->hasMany(SurveyType::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyUsersRels()
    {
        return $this->hasMany(SurveyUsersRel::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS0()
    {
        return $this->hasMany(Survey::className(), ['id' => 'sid'])->viaTable('survey_users_rel', ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTempRanges()
    {
        return $this->hasMany(TempRange::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTempRanges0()
    {
        return $this->hasMany(TempRange::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermConditions()
    {
        return $this->hasMany(TermCondition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermConditions0()
    {
        return $this->hasMany(TermCondition::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypePbs()
    {
        return $this->hasMany(TypePb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypePbs0()
    {
        return $this->hasMany(TypePb::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidateAccountMoves()
    {
        return $this->hasMany(ValidateAccountMove::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidateAccountMoves0()
    {
        return $this->hasMany(ValidateAccountMove::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidateAccountMoveLines()
    {
        return $this->hasMany(ValidateAccountMoveLines::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidateAccountMoveLines0()
    {
        return $this->hasMany(ValidateAccountMoveLines::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatuses()
    {
        return $this->hasMany(WeekStatus::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatuses0()
    {
        return $this->hasMany(WeekStatus::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatuses1()
    {
        return $this->hasMany(WeekStatus::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines0()
    {
        return $this->hasMany(WeekStatusLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardActivities()
    {
        return $this->hasMany(WizardActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardActivities0()
    {
        return $this->hasMany(WizardActivity::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardActivities1()
    {
        return $this->hasMany(WizardActivity::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualAhads()
    {
        return $this->hasMany(WizardAfterActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualAhads0()
    {
        return $this->hasMany(WizardAfterActualAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualJumats()
    {
        return $this->hasMany(WizardAfterActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualJumats0()
    {
        return $this->hasMany(WizardAfterActualJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualKamis()
    {
        return $this->hasMany(WizardAfterActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualKamis0()
    {
        return $this->hasMany(WizardAfterActualKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualRabus()
    {
        return $this->hasMany(WizardAfterActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualRabus0()
    {
        return $this->hasMany(WizardAfterActualRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSabtus()
    {
        return $this->hasMany(WizardAfterActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSabtus0()
    {
        return $this->hasMany(WizardAfterActualSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSelasas()
    {
        return $this->hasMany(WizardAfterActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSelasas0()
    {
        return $this->hasMany(WizardAfterActualSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSenins()
    {
        return $this->hasMany(WizardAfterActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterActualSenins0()
    {
        return $this->hasMany(WizardAfterActualSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanAhads()
    {
        return $this->hasMany(WizardAfterPlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanAhads0()
    {
        return $this->hasMany(WizardAfterPlanAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanJumats()
    {
        return $this->hasMany(WizardAfterPlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanJumats0()
    {
        return $this->hasMany(WizardAfterPlanJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanKamis()
    {
        return $this->hasMany(WizardAfterPlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanKamis0()
    {
        return $this->hasMany(WizardAfterPlanKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanRabus()
    {
        return $this->hasMany(WizardAfterPlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanRabus0()
    {
        return $this->hasMany(WizardAfterPlanRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSabtus()
    {
        return $this->hasMany(WizardAfterPlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSabtus0()
    {
        return $this->hasMany(WizardAfterPlanSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSelasas()
    {
        return $this->hasMany(WizardAfterPlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSelasas0()
    {
        return $this->hasMany(WizardAfterPlanSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSenins()
    {
        return $this->hasMany(WizardAfterPlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardAfterPlanSenins0()
    {
        return $this->hasMany(WizardAfterPlanSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualAhads()
    {
        return $this->hasMany(WizardBeforeActualAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualAhads0()
    {
        return $this->hasMany(WizardBeforeActualAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualJumats()
    {
        return $this->hasMany(WizardBeforeActualJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualJumats0()
    {
        return $this->hasMany(WizardBeforeActualJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualKamis()
    {
        return $this->hasMany(WizardBeforeActualKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualKamis0()
    {
        return $this->hasMany(WizardBeforeActualKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualRabus()
    {
        return $this->hasMany(WizardBeforeActualRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualRabus0()
    {
        return $this->hasMany(WizardBeforeActualRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSabtus()
    {
        return $this->hasMany(WizardBeforeActualSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSabtus0()
    {
        return $this->hasMany(WizardBeforeActualSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSelasas()
    {
        return $this->hasMany(WizardBeforeActualSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSelasas0()
    {
        return $this->hasMany(WizardBeforeActualSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSenins()
    {
        return $this->hasMany(WizardBeforeActualSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforeActualSenins0()
    {
        return $this->hasMany(WizardBeforeActualSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanAhads()
    {
        return $this->hasMany(WizardBeforePlanAhad::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanAhads0()
    {
        return $this->hasMany(WizardBeforePlanAhad::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanJumats()
    {
        return $this->hasMany(WizardBeforePlanJumat::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanJumats0()
    {
        return $this->hasMany(WizardBeforePlanJumat::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanKamis()
    {
        return $this->hasMany(WizardBeforePlanKamis::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanKamis0()
    {
        return $this->hasMany(WizardBeforePlanKamis::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanRabus()
    {
        return $this->hasMany(WizardBeforePlanRabu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanRabus0()
    {
        return $this->hasMany(WizardBeforePlanRabu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSabtus()
    {
        return $this->hasMany(WizardBeforePlanSabtu::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSabtus0()
    {
        return $this->hasMany(WizardBeforePlanSabtu::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSelasas()
    {
        return $this->hasMany(WizardBeforePlanSelasa::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSelasas0()
    {
        return $this->hasMany(WizardBeforePlanSelasa::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSenins()
    {
        return $this->hasMany(WizardBeforePlanSenin::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardBeforePlanSenins0()
    {
        return $this->hasMany(WizardBeforePlanSenin::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardCreatePbs()
    {
        return $this->hasMany(WizardCreatePb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardCreatePbs0()
    {
        return $this->hasMany(WizardCreatePb::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardCreatePbLines()
    {
        return $this->hasMany(WizardCreatePbLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardCreatePbLines0()
    {
        return $this->hasMany(WizardCreatePbLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardDetailPbs()
    {
        return $this->hasMany(WizardDetailPb::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardDetailPbs0()
    {
        return $this->hasMany(WizardDetailPb::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardIrModelMenuCreates()
    {
        return $this->hasMany(WizardIrModelMenuCreate::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardIrModelMenuCreates0()
    {
        return $this->hasMany(WizardIrModelMenuCreate::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardMultiChartsAccounts()
    {
        return $this->hasMany(WizardMultiChartsAccounts::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardMultiChartsAccounts0()
    {
        return $this->hasMany(WizardMultiChartsAccounts::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItems()
    {
        return $this->hasMany(WizardPoCancelItem::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItems0()
    {
        return $this->hasMany(WizardPoCancelItem::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItemLines()
    {
        return $this->hasMany(WizardPoCancelItemLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItemLines0()
    {
        return $this->hasMany(WizardPoCancelItemLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoRents()
    {
        return $this->hasMany(WizardPoRent::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoRents0()
    {
        return $this->hasMany(WizardPoRent::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoRevises()
    {
        return $this->hasMany(WizardPoRevise::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoRevises0()
    {
        return $this->hasMany(WizardPoRevise::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPrCancelItems()
    {
        return $this->hasMany(WizardPrCancelItem::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPrCancelItems0()
    {
        return $this->hasMany(WizardPrCancelItem::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails0()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardStockByLocations()
    {
        return $this->hasMany(WizardStockByLocation::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardStockByLocations0()
    {
        return $this->hasMany(WizardStockByLocation::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardStockByLocationLines()
    {
        return $this->hasMany(WizardStockByLocationLine::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardStockByLocationLines0()
    {
        return $this->hasMany(WizardStockByLocationLine::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardSupplierFirstPayments()
    {
        return $this->hasMany(WizardSupplierFirstPayment::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardSupplierFirstPayments0()
    {
        return $this->hasMany(WizardSupplierFirstPayment::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfs()
    {
        return $this->hasMany(Wkf::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfs0()
    {
        return $this->hasMany(Wkf::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfActivities()
    {
        return $this->hasMany(WkfActivity::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfActivities0()
    {
        return $this->hasMany(WkfActivity::className(), ['write_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfLogs()
    {
        return $this->hasMany(WkfLogs::className(), ['uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfTransitions()
    {
        return $this->hasMany(WkfTransition::className(), ['create_uid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfTransitions0()
    {
        return $this->hasMany(WkfTransition::className(), ['write_uid' => 'id']);
    }
    

    /* INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /*
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
/* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          // return static::findOne(['access_token' => $token]);
    	return null;
    }
 
/* removed
    public static function findIdentityByAccessToken($token)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
*/
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        // $this->password_hash = Security::generatePasswordHash($password);
        return False;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        // $this->auth_key = Security::generateRandomKey();
        return null;
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        // $this->password_reset_token = Security::generateRandomKey() . '_' . time();
        return null;
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /** EXTENSION MOVIE **/
}
