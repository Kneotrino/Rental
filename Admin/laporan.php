<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/detail_page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/nested_form_page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class laporanPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`laporan`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Laporan_Id', true, true, true),
                    new IntegerField('Laporan_Pemasukan'),
                    new IntegerField('Laporan_Pengeluaran'),
                    new IntegerField('Laporan_Mobil'),
                    new IntegerField('Laporan_Transaksi', true),
                    new StringField('Laporan_Keterangan'),
                    new DateTimeField('Laporan_Tanggal', true),
                    new DateTimeField('Laporan_Created', true)
                )
            );
            $this->dataset->AddLookupField('Laporan_Mobil', 'mobil', new IntegerField('Mobil_id'), new StringField('Mobil_No_Polisi', false, false, false, false, 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan_Mobil_Mobil_No_Polisi_mobil'), 'Laporan_Mobil_Mobil_No_Polisi_mobil');
            $this->dataset->AddLookupField('Laporan_Transaksi', 'transaksi', new IntegerField('Transaksi_ID'), new IntegerField('Transaksi_ID', false, false, false, false, 'Laporan_Transaksi_Transaksi_ID', 'Laporan_Transaksi_Transaksi_ID_transaksi'), 'Laporan_Transaksi_Transaksi_ID_transaksi');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'Laporan_Id', 'Laporan_Id', 'Laporan Id'),
                new FilterColumn($this->dataset, 'Laporan_Pemasukan', 'Laporan_Pemasukan', 'Pemasukan 10%'),
                new FilterColumn($this->dataset, 'Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Setoran Pemilik Mobil'),
                new FilterColumn($this->dataset, 'Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan'),
                new FilterColumn($this->dataset, 'Laporan_Tanggal', 'Laporan_Tanggal', 'Tanggal Pembayaran'),
                new FilterColumn($this->dataset, 'Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil'),
                new FilterColumn($this->dataset, 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'Laporan Transaksi'),
                new FilterColumn($this->dataset, 'Laporan_Created', 'Laporan_Created', 'Tanggal Input')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Laporan_Id'])
                ->addColumn($columns['Laporan_Pemasukan'])
                ->addColumn($columns['Laporan_Pengeluaran'])
                ->addColumn($columns['Laporan_Keterangan'])
                ->addColumn($columns['Laporan_Tanggal'])
                ->addColumn($columns['Laporan_Mobil'])
                ->addColumn($columns['Laporan_Transaksi'])
                ->addColumn($columns['Laporan_Created']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Laporan_Tanggal')
                ->setOptionsFor('Laporan_Mobil')
                ->setOptionsFor('Laporan_Transaksi')
                ->setOptionsFor('Laporan_Created');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('laporan_id_edit');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('laporan_pemasukan_edit');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Pemasukan'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('laporan_pengeluaran_edit');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Pengeluaran'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('Laporan_Keterangan');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Keterangan'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('laporan_tanggal_edit', false, 'd-m-Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Tanggal'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('laporan_mobil_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Laporan_Mobil_Mobil_No_Polisi_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Laporan_Mobil', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Laporan_Mobil_Mobil_No_Polisi_search');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Mobil'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('laporan_transaksi_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Laporan_Transaksi_Transaksi_ID_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Laporan_Transaksi', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Laporan_Transaksi_Transaksi_ID_search');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Transaksi'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('laporan_created_edit', false, 'd-m-Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Laporan_Created'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new AjaxOperation(OPERATION_EDIT,
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'),
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'), $this->dataset,
                    $this->GetGridEditHandler(), $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for Laporan_Id field
            //
            $column = new NumberViewColumn('Laporan_Id', 'Laporan_Id', 'Laporan Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Pemasukan field
            //
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Pemasukan 10%', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Setoran Pemilik Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('laporanGrid_Laporan_Keterangan_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Tanggal Pembayaran', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/mobil.php?operation=view&pk0=%Laporan_Mobil%');
            $column->setTarget('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/transaksi.php?operation=view&pk0=%Laporan_Transaksi%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Tanggal Input', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Laporan_Id field
            //
            $column = new NumberViewColumn('Laporan_Id', 'Laporan_Id', 'Laporan Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Pemasukan field
            //
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Pemasukan 10%', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Setoran Pemilik Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('laporanGrid_Laporan_Keterangan_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Tanggal Pembayaran', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/mobil.php?operation=view&pk0=%Laporan_Mobil%');
            $column->setTarget('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/transaksi.php?operation=view&pk0=%Laporan_Transaksi%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Tanggal Input', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Laporan_Pemasukan field
            //
            $editor = new TextEdit('laporan_pemasukan_edit');
            $editColumn = new CustomEditColumn('Pemasukan 10%', 'Laporan_Pemasukan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Pengeluaran field
            //
            $editor = new TextEdit('laporan_pengeluaran_edit');
            $editColumn = new CustomEditColumn('Setoran Pemilik Mobil', 'Laporan_Pengeluaran', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Keterangan field
            //
            $editor = new TextAreaEdit('laporan_keterangan_edit', 50, 8);
            $editColumn = new CustomEditColumn('Laporan Keterangan', 'Laporan_Keterangan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Tanggal field
            //
            $editor = new DateTimeEdit('laporan_tanggal_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Pembayaran', 'Laporan_Tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Mobil field
            //
            $editor = new DynamicCombobox('laporan_mobil_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Mobil', 'Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'edit_Laporan_Mobil_Mobil_No_Polisi_search', $editor, $this->dataset, $lookupDataset, 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Transaksi field
            //
            $editor = new DynamicCombobox('laporan_transaksi_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Transaksi', 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'edit_Laporan_Transaksi_Transaksi_ID_search', $editor, $this->dataset, $lookupDataset, 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Laporan_Pemasukan field
            //
            $editor = new TextEdit('laporan_pemasukan_edit');
            $editColumn = new CustomEditColumn('Pemasukan 10%', 'Laporan_Pemasukan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Pengeluaran field
            //
            $editor = new TextEdit('laporan_pengeluaran_edit');
            $editColumn = new CustomEditColumn('Setoran Pemilik Mobil', 'Laporan_Pengeluaran', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Keterangan field
            //
            $editor = new TextAreaEdit('laporan_keterangan_edit', 50, 8);
            $editColumn = new CustomEditColumn('Laporan Keterangan', 'Laporan_Keterangan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Tanggal field
            //
            $editor = new DateTimeEdit('laporan_tanggal_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Pembayaran', 'Laporan_Tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Mobil field
            //
            $editor = new DynamicCombobox('laporan_mobil_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Mobil', 'Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'multi_edit_Laporan_Mobil_Mobil_No_Polisi_search', $editor, $this->dataset, $lookupDataset, 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Transaksi field
            //
            $editor = new DynamicCombobox('laporan_transaksi_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Transaksi', 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'multi_edit_Laporan_Transaksi_Transaksi_ID_search', $editor, $this->dataset, $lookupDataset, 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Laporan_Pemasukan field
            //
            $editor = new TextEdit('laporan_pemasukan_edit');
            $editColumn = new CustomEditColumn('Pemasukan 10%', 'Laporan_Pemasukan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Pengeluaran field
            //
            $editor = new TextEdit('laporan_pengeluaran_edit');
            $editColumn = new CustomEditColumn('Setoran Pemilik Mobil', 'Laporan_Pengeluaran', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Keterangan field
            //
            $editor = new TextAreaEdit('laporan_keterangan_edit', 50, 8);
            $editColumn = new CustomEditColumn('Laporan Keterangan', 'Laporan_Keterangan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Tanggal field
            //
            $editor = new DateTimeEdit('laporan_tanggal_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Pembayaran', 'Laporan_Tanggal', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATE%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Mobil field
            //
            $editor = new DynamicCombobox('laporan_mobil_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Mobil', 'Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'insert_Laporan_Mobil_Mobil_No_Polisi_search', $editor, $this->dataset, $lookupDataset, 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Transaksi field
            //
            $editor = new DynamicCombobox('laporan_transaksi_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Transaksi', 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'insert_Laporan_Transaksi_Transaksi_ID_search', $editor, $this->dataset, $lookupDataset, 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for Laporan_Id field
            //
            $column = new NumberViewColumn('Laporan_Id', 'Laporan_Id', 'Laporan Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Pemasukan field
            //
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Pemasukan 10%', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Setoran Pemilik Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('laporanGrid_Laporan_Keterangan_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Tanggal Pembayaran', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/mobil.php?operation=view&pk0=%Laporan_Mobil%');
            $column->setTarget('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/transaksi.php?operation=view&pk0=%Laporan_Transaksi%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Tanggal Input', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Laporan_Id field
            //
            $column = new NumberViewColumn('Laporan_Id', 'Laporan_Id', 'Laporan Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Pemasukan field
            //
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Pemasukan 10%', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Setoran Pemilik Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('laporanGrid_Laporan_Keterangan_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Tanggal Pembayaran', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/mobil.php?operation=view&pk0=%Laporan_Mobil%');
            $column->setTarget('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/transaksi.php?operation=view&pk0=%Laporan_Transaksi%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Tanggal Input', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Laporan_Pemasukan field
            //
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Pemasukan 10%', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Setoran Pemilik Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('laporanGrid_Laporan_Keterangan_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Tanggal Pembayaran', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/mobil.php?operation=view&pk0=%Laporan_Mobil%');
            $column->setTarget('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_ID', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('http://localhost/Rental/admin/transaksi.php?operation=view&pk0=%Laporan_Transaksi%');
            $column->setTarget('');
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Tanggal Input', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        
        public function GetEnableModalGridInsert() { return true; }
        public function GetEnableModalGridEdit() { return true; }
        
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(false);
            $defaultSortedColumns = array();
            $defaultSortedColumns[] = new SortColumn('Laporan_Created', 'DESC');
            $result->setDefaultOrdering($defaultSortedColumns);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setUseModalMultiEdit(true);
            $result->setTableBordered(false);
            $result->setTableCondensed(true);
            $result->SetTotal('Laporan_Pemasukan', PredefinedAggregate::$Sum);
            $result->SetTotal('Laporan_Pengeluaran', PredefinedAggregate::$Sum);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'laporanGrid_Laporan_Keterangan_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'laporanGrid_Laporan_Keterangan_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'laporanGrid_Laporan_Keterangan_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Laporan_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Laporan_Transaksi_Transaksi_ID_search', 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Laporan_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Laporan_Transaksi_Transaksi_ID_search', 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'laporanGrid_Laporan_Keterangan_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Laporan_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Laporan_Transaksi_Transaksi_ID_search', 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna'),
                    new StringField('Aktif', true)
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Laporan_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Transaksi_ID', true, true, true),
                    new StringField('Transaksi_Nama'),
                    new StringField('Transaksi_NomorHP'),
                    new StringField('Transaksi_Alamat'),
                    new StringField('Transaksi_Jaminan_Identitas'),
                    new StringField('Transaksi_Nomor_Jaminan_Identitas'),
                    new IntegerField('Transaksi_Mobil'),
                    new IntegerField('Transaksi_Laporan', true),
                    new IntegerField('Transaksi_Posisi_Bensin'),
                    new DateField('Transaksi_Tanggal'),
                    new IntegerField('Masa_Sewa_Jam'),
                    new IntegerField('Masa_Sewa_Hari'),
                    new IntegerField('Masa_Sewa_Bulan'),
                    new IntegerField('Masa_Sewa_Tahun'),
                    new StringField('Kelengkapan'),
                    new DateTimeField('Tangal_Waktu_Mulai', true),
                    new DateTimeField('Tanggal_Waktu_Berakhir'),
                    new IntegerField('Jumlah_Stor', true),
                    new IntegerField('Jumlah_Tagihan', true),
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_ID', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Laporan_Transaksi_Transaksi_ID_search', 'Transaksi_ID', 'Transaksi_ID', '%Transaksi_ID%-%Transaksi_Nama%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new laporanPage("laporan", "laporan.php", GetCurrentUserPermissionSetForDataSource("laporan"), 'UTF-8');
        $Page->SetTitle('Laporan');
        $Page->SetMenuLabel('Laporan');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("laporan"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
