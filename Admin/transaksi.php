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
    
    
    
    class transaksi_laporanPage extends DetailPage
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
            $this->dataset->AddLookupField('Laporan_Transaksi', 'transaksi', new IntegerField('Transaksi_ID'), new StringField('Transaksi_Nama', false, false, false, false, 'Laporan_Transaksi_Transaksi_Nama', 'Laporan_Transaksi_Transaksi_Nama_transaksi'), 'Laporan_Transaksi_Transaksi_Nama_transaksi');
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
                new FilterColumn($this->dataset, 'Laporan_Pemasukan', 'Laporan_Pemasukan', 'Laporan Pemasukan'),
                new FilterColumn($this->dataset, 'Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Laporan Pengeluaran'),
                new FilterColumn($this->dataset, 'Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil'),
                new FilterColumn($this->dataset, 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'Laporan Transaksi'),
                new FilterColumn($this->dataset, 'Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan'),
                new FilterColumn($this->dataset, 'Laporan_Tanggal', 'Laporan_Tanggal', 'Laporan Tanggal'),
                new FilterColumn($this->dataset, 'Laporan_Created', 'Laporan_Created', 'Laporan Created')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Laporan_Id'])
                ->addColumn($columns['Laporan_Pemasukan'])
                ->addColumn($columns['Laporan_Pengeluaran'])
                ->addColumn($columns['Laporan_Mobil'])
                ->addColumn($columns['Laporan_Transaksi'])
                ->addColumn($columns['Laporan_Keterangan'])
                ->addColumn($columns['Laporan_Tanggal'])
                ->addColumn($columns['Laporan_Created']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Laporan_Mobil')
                ->setOptionsFor('Laporan_Transaksi')
                ->setOptionsFor('Laporan_Tanggal')
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
            $main_editor->SetHandlerName('filter_builder_Laporan_Transaksi_Transaksi_Nama_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Laporan_Transaksi', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Laporan_Transaksi_Transaksi_Nama_search');
            
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
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Laporan Pemasukan', $this->dataset);
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
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Laporan Pengeluaran', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
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
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.laporan_Laporan_Keterangan_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Laporan Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Laporan Created', $this->dataset);
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
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Laporan Pemasukan', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Laporan Pengeluaran', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.laporan_Laporan_Keterangan_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Laporan Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Laporan Created', $this->dataset);
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
            $editColumn = new CustomEditColumn('Laporan Pemasukan', 'Laporan_Pemasukan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Pengeluaran field
            //
            $editor = new TextEdit('laporan_pengeluaran_edit');
            $editColumn = new CustomEditColumn('Laporan Pengeluaran', 'Laporan_Pengeluaran', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Transaksi', 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'edit_Laporan_Transaksi_Transaksi_Nama_search', $editor, $this->dataset, $lookupDataset, 'Transaksi_ID', 'Transaksi_Nama', '');
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new CustomEditColumn('Laporan Tanggal', 'Laporan_Tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Created field
            //
            $editor = new DateTimeEdit('laporan_created_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Laporan Created', 'Laporan_Created', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setVisible(false);
            $editColumn->setEnabled(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Laporan_Pemasukan field
            //
            $editor = new TextEdit('laporan_pemasukan_edit');
            $editColumn = new CustomEditColumn('Laporan Pemasukan', 'Laporan_Pemasukan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Pengeluaran field
            //
            $editor = new TextEdit('laporan_pengeluaran_edit');
            $editColumn = new CustomEditColumn('Laporan Pengeluaran', 'Laporan_Pengeluaran', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Transaksi', 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'multi_edit_Laporan_Transaksi_Transaksi_Nama_search', $editor, $this->dataset, $lookupDataset, 'Transaksi_ID', 'Transaksi_Nama', '');
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new CustomEditColumn('Laporan Tanggal', 'Laporan_Tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Laporan_Created field
            //
            $editor = new DateTimeEdit('laporan_created_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Laporan Created', 'Laporan_Created', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setVisible(false);
            $editColumn->setEnabled(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Laporan_Pemasukan field
            //
            $editor = new TextEdit('laporan_pemasukan_edit');
            $editColumn = new CustomEditColumn('Laporan Pemasukan', 'Laporan_Pemasukan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Pengeluaran field
            //
            $editor = new TextEdit('laporan_pengeluaran_edit');
            $editColumn = new CustomEditColumn('Laporan Pengeluaran', 'Laporan_Pengeluaran', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Laporan Transaksi', 'Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'insert_Laporan_Transaksi_Transaksi_Nama_search', $editor, $this->dataset, $lookupDataset, 'Transaksi_ID', 'Transaksi_Nama', '');
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new CustomEditColumn('Laporan Tanggal', 'Laporan_Tanggal', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATE%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Laporan_Created field
            //
            $editor = new DateTimeEdit('laporan_created_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Laporan Created', 'Laporan_Created', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setVisible(false);
            $editColumn->setEnabled(false);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATETIME%');
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
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Laporan Pemasukan', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Laporan Pengeluaran', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.laporan_Laporan_Keterangan_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Laporan Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Laporan Created', $this->dataset);
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
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Laporan Pemasukan', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Laporan Pengeluaran', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.laporan_Laporan_Keterangan_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Laporan Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Laporan Created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Laporan_Pemasukan field
            //
            $column = new NumberViewColumn('Laporan_Pemasukan', 'Laporan_Pemasukan', 'Laporan Pemasukan', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Pengeluaran field
            //
            $column = new NumberViewColumn('Laporan_Pengeluaran', 'Laporan_Pengeluaran', 'Laporan Pengeluaran', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Laporan_Mobil', 'Laporan_Mobil_Mobil_No_Polisi', 'Laporan Mobil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Laporan_Transaksi', 'Laporan_Transaksi_Transaksi_Nama', 'Laporan Transaksi', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.laporan_Laporan_Keterangan_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Tanggal field
            //
            $column = new DateTimeViewColumn('Laporan_Tanggal', 'Laporan_Tanggal', 'Laporan Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Laporan_Created field
            //
            $column = new DateTimeViewColumn('Laporan_Created', 'Laporan_Created', 'Laporan Created', $this->dataset);
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
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setUseModalMultiEdit(true);
            $result->setTableBordered(false);
            $result->setTableCondensed(true);
            
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
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.laporan_Laporan_Keterangan_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.laporan_Laporan_Keterangan_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.laporan_Laporan_Keterangan_handler_compare', $column);
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Laporan_Transaksi_Transaksi_Nama_search', 'Transaksi_ID', 'Transaksi_Nama', null, 20);
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Laporan_Transaksi_Transaksi_Nama_search', 'Transaksi_ID', 'Transaksi_Nama', null, 20);
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Laporan_Transaksi_Transaksi_Nama_search', 'Transaksi_ID', 'Transaksi_Nama', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Laporan_Keterangan field
            //
            $column = new TextViewColumn('Laporan_Keterangan', 'Laporan_Keterangan', 'Laporan Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.laporan_Laporan_Keterangan_handler_view', $column);
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Laporan_Transaksi_Transaksi_Nama_search', 'Transaksi_ID', 'Transaksi_Nama', null, 20);
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
                    new StringField('Mobil_Warna')
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $lookupDataset->setOrderByField('Transaksi_Nama', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Laporan_Transaksi_Transaksi_Nama_search', 'Transaksi_ID', 'Transaksi_Nama', null, 20);
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
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class transaksi_mobilPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`mobil`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Mobil_id', true, true, true),
                    new StringField('Mobil_Keterangan'),
                    new StringField('Mobil_Merk'),
                    new StringField('Mobil_No_Polisi'),
                    new IntegerField('Mobil_Tahun'),
                    new StringField('Mobil_Tipe'),
                    new StringField('Mobil_Warna')
                )
            );
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
                new FilterColumn($this->dataset, 'Mobil_id', 'Mobil_id', 'Mobil Id'),
                new FilterColumn($this->dataset, 'Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan'),
                new FilterColumn($this->dataset, 'Mobil_Merk', 'Mobil_Merk', 'Mobil Merk'),
                new FilterColumn($this->dataset, 'Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi'),
                new FilterColumn($this->dataset, 'Mobil_Tahun', 'Mobil_Tahun', 'Mobil Tahun'),
                new FilterColumn($this->dataset, 'Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe'),
                new FilterColumn($this->dataset, 'Mobil_Warna', 'Mobil_Warna', 'Mobil Warna')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Mobil_id'])
                ->addColumn($columns['Mobil_Keterangan'])
                ->addColumn($columns['Mobil_Merk'])
                ->addColumn($columns['Mobil_No_Polisi'])
                ->addColumn($columns['Mobil_Tahun'])
                ->addColumn($columns['Mobil_Tipe'])
                ->addColumn($columns['Mobil_Warna']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('mobil_id_edit');
            
            $filterBuilder->addColumn(
                $columns['Mobil_id'],
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
            
            $main_editor = new TextEdit('mobil_keterangan_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Mobil_Keterangan'],
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
            
            $main_editor = new TextEdit('mobil_merk_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Mobil_Merk'],
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
            
            $main_editor = new TextEdit('mobil_no_polisi_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Mobil_No_Polisi'],
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
            
            $main_editor = new TextEdit('mobil_tahun_edit');
            
            $filterBuilder->addColumn(
                $columns['Mobil_Tahun'],
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
            
            $main_editor = new TextEdit('mobil_tipe_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Mobil_Tipe'],
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
            
            $main_editor = new TextEdit('mobil_warna_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Mobil_Warna'],
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
            // View column for Mobil_id field
            //
            $column = new NumberViewColumn('Mobil_id', 'Mobil_id', 'Mobil Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Keterangan_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Merk_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_Tahun field
            //
            $column = new NumberViewColumn('Mobil_Tahun', 'Mobil_Tahun', 'Mobil Tahun', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Tipe_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Warna_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Mobil_id field
            //
            $column = new NumberViewColumn('Mobil_id', 'Mobil_id', 'Mobil Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Keterangan_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Merk_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_Tahun field
            //
            $column = new NumberViewColumn('Mobil_Tahun', 'Mobil_Tahun', 'Mobil Tahun', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Tipe_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Warna_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
    
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for Mobil_id field
            //
            $column = new NumberViewColumn('Mobil_id', 'Mobil_id', 'Mobil Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Keterangan_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Merk_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_Tahun field
            //
            $column = new NumberViewColumn('Mobil_Tahun', 'Mobil_Tahun', 'Mobil Tahun', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Tipe_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Warna_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Mobil_id field
            //
            $column = new NumberViewColumn('Mobil_id', 'Mobil_id', 'Mobil Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Keterangan_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Merk_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_Tahun field
            //
            $column = new NumberViewColumn('Mobil_Tahun', 'Mobil_Tahun', 'Mobil Tahun', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Tipe_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Warna_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Keterangan_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Merk_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_Tahun field
            //
            $column = new NumberViewColumn('Mobil_Tahun', 'Mobil_Tahun', 'Mobil Tahun', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Tipe_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('DetailGridtransaksi.mobil_Mobil_Warna_handler_compare');
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
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowAddMultipleRecords(false);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setUseModalMultiEdit(true);
            $result->setTableBordered(false);
            $result->setTableCondensed(true);
            
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
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Keterangan_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Merk_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Tipe_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Warna_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Keterangan_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Merk_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Tipe_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Warna_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Keterangan_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Merk_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Tipe_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Warna_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Keterangan field
            //
            $column = new TextViewColumn('Mobil_Keterangan', 'Mobil_Keterangan', 'Mobil Keterangan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Keterangan_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Merk field
            //
            $column = new TextViewColumn('Mobil_Merk', 'Mobil_Merk', 'Mobil Merk', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Merk_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Mobil_No_Polisi', 'Mobil_No_Polisi', 'Mobil No Polisi', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_No_Polisi_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Tipe field
            //
            $column = new TextViewColumn('Mobil_Tipe', 'Mobil_Tipe', 'Mobil Tipe', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Tipe_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Mobil_Warna field
            //
            $column = new TextViewColumn('Mobil_Warna', 'Mobil_Warna', 'Mobil Warna', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'DetailGridtransaksi.mobil_Mobil_Warna_handler_view', $column);
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
    
    // OnBeforePageExecute event handler
    
    
    
    class transaksiPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`transaksi`');
            $this->dataset->addFields(
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
                    new StringField('Keterangan_Lainnya'),
                    new StringField('Print', true)
                )
            );
            $this->dataset->AddLookupField('Transaksi_Mobil', 'mobil', new IntegerField('Mobil_id'), new StringField('Mobil_No_Polisi', false, false, false, false, 'Transaksi_Mobil_Mobil_No_Polisi', 'Transaksi_Mobil_Mobil_No_Polisi_mobil'), 'Transaksi_Mobil_Mobil_No_Polisi_mobil');
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
                new FilterColumn($this->dataset, 'Transaksi_ID', 'Transaksi_ID', 'Transaksi ID'),
                new FilterColumn($this->dataset, 'Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu'),
                new FilterColumn($this->dataset, 'Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu'),
                new FilterColumn($this->dataset, 'Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu'),
                new FilterColumn($this->dataset, 'Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan'),
                new FilterColumn($this->dataset, 'Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu'),
                new FilterColumn($this->dataset, 'Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'Jenis Mobil '),
                new FilterColumn($this->dataset, 'Transaksi_Posisi_Bensin', 'Transaksi_Posisi_Bensin', 'Posisi Bensin (Kotak)'),
                new FilterColumn($this->dataset, 'Masa_Sewa_Jam', 'Masa_Sewa_Jam', 'Jam Sewa'),
                new FilterColumn($this->dataset, 'Masa_Sewa_Hari', 'Masa_Sewa_Hari', 'Hari Sewa'),
                new FilterColumn($this->dataset, 'Masa_Sewa_Bulan', 'Masa_Sewa_Bulan', 'Bulan Sewa'),
                new FilterColumn($this->dataset, 'Masa_Sewa_Tahun', 'Masa_Sewa_Tahun', 'Tahun Sewa'),
                new FilterColumn($this->dataset, 'Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan'),
                new FilterColumn($this->dataset, 'Transaksi_Tanggal', 'Transaksi_Tanggal', 'Tanggal Bayar'),
                new FilterColumn($this->dataset, 'Tangal_Waktu_Mulai', 'Tangal_Waktu_Mulai', 'Tanggal Dan Jam Keluar'),
                new FilterColumn($this->dataset, 'Tanggal_Waktu_Berakhir', 'Tanggal_Waktu_Berakhir', 'Tanggal Dan Jam Masuk'),
                new FilterColumn($this->dataset, 'Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya'),
                new FilterColumn($this->dataset, 'Transaksi_Laporan', 'Transaksi_Laporan', 'Transaksi Laporan'),
                new FilterColumn($this->dataset, 'Print', 'Print', 'Print')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Transaksi_Nama'])
                ->addColumn($columns['Transaksi_NomorHP'])
                ->addColumn($columns['Transaksi_Alamat'])
                ->addColumn($columns['Transaksi_Jaminan_Identitas'])
                ->addColumn($columns['Transaksi_Nomor_Jaminan_Identitas'])
                ->addColumn($columns['Transaksi_Mobil'])
                ->addColumn($columns['Transaksi_Posisi_Bensin'])
                ->addColumn($columns['Masa_Sewa_Jam'])
                ->addColumn($columns['Masa_Sewa_Hari'])
                ->addColumn($columns['Masa_Sewa_Bulan'])
                ->addColumn($columns['Masa_Sewa_Tahun'])
                ->addColumn($columns['Kelengkapan'])
                ->addColumn($columns['Transaksi_Tanggal'])
                ->addColumn($columns['Tangal_Waktu_Mulai'])
                ->addColumn($columns['Tanggal_Waktu_Berakhir'])
                ->addColumn($columns['Keterangan_Lainnya']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Transaksi_Mobil')
                ->setOptionsFor('Transaksi_Tanggal')
                ->setOptionsFor('Tangal_Waktu_Mulai')
                ->setOptionsFor('Tanggal_Waktu_Berakhir');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('transaksi_id_edit');
            
            $filterBuilder->addColumn(
                $columns['Transaksi_ID'],
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
            
            $main_editor = new TextEdit('transaksi_nama_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Nama'],
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
            
            $main_editor = new TextEdit('transaksi_nomorhp_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Transaksi_NomorHP'],
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
            
            $main_editor = new TextEdit('transaksi_alamat_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Alamat'],
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
            
            $main_editor = new TextEdit('transaksi_jaminan_identitas_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Jaminan_Identitas'],
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
            
            $main_editor = new TextEdit('transaksi_nomor_jaminan_identitas_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Nomor_Jaminan_Identitas'],
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
            
            $main_editor = new DynamicCombobox('transaksi_mobil_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_Transaksi_Mobil_Mobil_No_Polisi_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Transaksi_Mobil', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_Transaksi_Mobil_Mobil_No_Polisi_search');
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Mobil'],
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
            
            $main_editor = new TextEdit('transaksi_posisi_bensin_edit');
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Posisi_Bensin'],
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
            
            $main_editor = new TextEdit('masa_sewa_jam_edit');
            
            $filterBuilder->addColumn(
                $columns['Masa_Sewa_Jam'],
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
            
            $main_editor = new TextEdit('masa_sewa_hari_edit');
            
            $filterBuilder->addColumn(
                $columns['Masa_Sewa_Hari'],
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
            
            $main_editor = new TextEdit('masa_sewa_bulan_edit');
            
            $filterBuilder->addColumn(
                $columns['Masa_Sewa_Bulan'],
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
            
            $main_editor = new TextEdit('masa_sewa_tahun_edit');
            
            $filterBuilder->addColumn(
                $columns['Masa_Sewa_Tahun'],
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
            
            $main_editor = new TextEdit('Kelengkapan');
            
            $filterBuilder->addColumn(
                $columns['Kelengkapan'],
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
            
            $main_editor = new DateTimeEdit('transaksi_tanggal_edit', false, 'd-m-Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Transaksi_Tanggal'],
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
            
            $main_editor = new DateTimeEdit('tangal_waktu_mulai_edit', false, 'd-m-Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Tangal_Waktu_Mulai'],
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
            
            $main_editor = new DateTimeEdit('tanggal_waktu_berakhir_edit', false, 'd-m-Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Tanggal_Waktu_Berakhir'],
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
            
            $main_editor = new TextEdit('Keterangan_Lainnya');
            
            $filterBuilder->addColumn(
                $columns['Keterangan_Lainnya'],
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
            if (GetCurrentUserPermissionSetForDataSource('transaksi.laporan')->HasViewGrant() && $withDetails)
            {
            //
            // View column for transaksi_laporan detail
            //
            $column = new DetailColumn(array('Transaksi_ID'), 'transaksi.laporan', 'transaksi_laporan_handler', $this->dataset, 'Laporan');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('transaksi.mobil')->HasViewGrant() && $withDetails)
            {
            //
            // View column for transaksi_mobil detail
            //
            $column = new DetailColumn(array('Transaksi_Mobil'), 'transaksi.mobil', 'transaksi_mobil_handler', $this->dataset, 'Mobil');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Transaksi_ID', 'Transaksi_ID', 'Transaksi ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nama_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_NomorHP_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Alamat_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Jaminan_Identitas_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'Jenis Mobil ', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Posisi_Bensin field
            //
            $column = new NumberViewColumn('Transaksi_Posisi_Bensin', 'Transaksi_Posisi_Bensin', 'Posisi Bensin (Kotak)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Masa_Sewa_Jam field
            //
            $column = new NumberViewColumn('Masa_Sewa_Jam', 'Masa_Sewa_Jam', 'Jam Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Masa_Sewa_Hari field
            //
            $column = new NumberViewColumn('Masa_Sewa_Hari', 'Masa_Sewa_Hari', 'Hari Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Masa_Sewa_Bulan field
            //
            $column = new NumberViewColumn('Masa_Sewa_Bulan', 'Masa_Sewa_Bulan', 'Bulan Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Masa_Sewa_Tahun field
            //
            $column = new NumberViewColumn('Masa_Sewa_Tahun', 'Masa_Sewa_Tahun', 'Tahun Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Kelengkapan_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Transaksi_Tanggal field
            //
            $column = new DateTimeViewColumn('Transaksi_Tanggal', 'Transaksi_Tanggal', 'Tanggal Bayar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Tangal_Waktu_Mulai field
            //
            $column = new DateTimeViewColumn('Tangal_Waktu_Mulai', 'Tangal_Waktu_Mulai', 'Tanggal Dan Jam Keluar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Tanggal_Waktu_Berakhir field
            //
            $column = new DateTimeViewColumn('Tanggal_Waktu_Berakhir', 'Tanggal_Waktu_Berakhir', 'Tanggal Dan Jam Masuk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Keterangan_Lainnya_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Print field
            //
            $column = new TextViewColumn('Print', 'Print', 'Print', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('print.php?id=%Transaksi_ID%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Print_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Transaksi_ID', 'Transaksi_ID', 'Transaksi ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nama_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_NomorHP_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Alamat_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Jaminan_Identitas_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'Jenis Mobil ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Posisi_Bensin field
            //
            $column = new NumberViewColumn('Transaksi_Posisi_Bensin', 'Transaksi_Posisi_Bensin', 'Posisi Bensin (Kotak)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Masa_Sewa_Jam field
            //
            $column = new NumberViewColumn('Masa_Sewa_Jam', 'Masa_Sewa_Jam', 'Jam Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Masa_Sewa_Hari field
            //
            $column = new NumberViewColumn('Masa_Sewa_Hari', 'Masa_Sewa_Hari', 'Hari Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Masa_Sewa_Bulan field
            //
            $column = new NumberViewColumn('Masa_Sewa_Bulan', 'Masa_Sewa_Bulan', 'Bulan Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Masa_Sewa_Tahun field
            //
            $column = new NumberViewColumn('Masa_Sewa_Tahun', 'Masa_Sewa_Tahun', 'Tahun Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Kelengkapan_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Transaksi_Tanggal field
            //
            $column = new DateTimeViewColumn('Transaksi_Tanggal', 'Transaksi_Tanggal', 'Tanggal Bayar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Tangal_Waktu_Mulai field
            //
            $column = new DateTimeViewColumn('Tangal_Waktu_Mulai', 'Tangal_Waktu_Mulai', 'Tanggal Dan Jam Keluar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Tanggal_Waktu_Berakhir field
            //
            $column = new DateTimeViewColumn('Tanggal_Waktu_Berakhir', 'Tanggal_Waktu_Berakhir', 'Tanggal Dan Jam Masuk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Keterangan_Lainnya_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Print field
            //
            $column = new TextViewColumn('Print', 'Print', 'Print', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('print.php?id=%Transaksi_ID%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Print_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Transaksi_ID field
            //
            $editor = new TextEdit('transaksi_id_edit');
            $editColumn = new CustomEditColumn('Transaksi ID', 'Transaksi_ID', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Nama field
            //
            $editor = new TextEdit('transaksi_nama_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nama Tamu', 'Transaksi_Nama', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_NomorHP field
            //
            $editor = new TextEdit('transaksi_nomorhp_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nomor HP Tamu', 'Transaksi_NomorHP', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Alamat field
            //
            $editor = new TextEdit('transaksi_alamat_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Alamat  Tamu', 'Transaksi_Alamat', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Jaminan_Identitas field
            //
            $editor = new TextEdit('transaksi_jaminan_identitas_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Identitas yang dijaminkan', 'Transaksi_Jaminan_Identitas', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $editor = new TextEdit('transaksi_nomor_jaminan_identitas_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nomor Identitas  Tamu', 'Transaksi_Nomor_Jaminan_Identitas', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Mobil field
            //
            $editor = new DynamicCombobox('transaksi_mobil_edit', $this->CreateLinkBuilder());
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Jenis Mobil ', 'Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'edit_Transaksi_Mobil_Mobil_No_Polisi_search', $editor, $this->dataset, $lookupDataset, 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Posisi_Bensin field
            //
            $editor = new TextEdit('transaksi_posisi_bensin_edit');
            $editColumn = new CustomEditColumn('Posisi Bensin (Kotak)', 'Transaksi_Posisi_Bensin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Jam field
            //
            $editor = new TextEdit('masa_sewa_jam_edit');
            $editColumn = new CustomEditColumn('Jam Sewa', 'Masa_Sewa_Jam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Hari field
            //
            $editor = new TextEdit('masa_sewa_hari_edit');
            $editColumn = new CustomEditColumn('Hari Sewa', 'Masa_Sewa_Hari', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Bulan field
            //
            $editor = new TextEdit('masa_sewa_bulan_edit');
            $editColumn = new CustomEditColumn('Bulan Sewa', 'Masa_Sewa_Bulan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Tahun field
            //
            $editor = new TextEdit('masa_sewa_tahun_edit');
            $editColumn = new CustomEditColumn('Tahun Sewa', 'Masa_Sewa_Tahun', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Kelengkapan field
            //
            $editor = new TextAreaEdit('kelengkapan_edit', 50, 8);
            $editColumn = new CustomEditColumn('Kelengkapan Kendaraan', 'Kelengkapan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Tanggal field
            //
            $editor = new DateTimeEdit('transaksi_tanggal_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Bayar', 'Transaksi_Tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Tangal_Waktu_Mulai field
            //
            $editor = new DateTimeEdit('tangal_waktu_mulai_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Dan Jam Keluar', 'Tangal_Waktu_Mulai', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Tanggal_Waktu_Berakhir field
            //
            $editor = new DateTimeEdit('tanggal_waktu_berakhir_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Dan Jam Masuk', 'Tanggal_Waktu_Berakhir', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Keterangan_Lainnya field
            //
            $editor = new TextAreaEdit('keterangan_lainnya_edit', 50, 8);
            $editColumn = new CustomEditColumn('Keterangan Lainnya', 'Keterangan_Lainnya', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Transaksi_Nama field
            //
            $editor = new TextEdit('transaksi_nama_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nama Tamu', 'Transaksi_Nama', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_NomorHP field
            //
            $editor = new TextEdit('transaksi_nomorhp_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nomor HP Tamu', 'Transaksi_NomorHP', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Alamat field
            //
            $editor = new TextEdit('transaksi_alamat_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Alamat  Tamu', 'Transaksi_Alamat', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Jaminan_Identitas field
            //
            $editor = new TextEdit('transaksi_jaminan_identitas_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Identitas yang dijaminkan', 'Transaksi_Jaminan_Identitas', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $editor = new TextEdit('transaksi_nomor_jaminan_identitas_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nomor Identitas  Tamu', 'Transaksi_Nomor_Jaminan_Identitas', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Mobil field
            //
            $editor = new DynamicCombobox('transaksi_mobil_edit', $this->CreateLinkBuilder());
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Jenis Mobil ', 'Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'multi_edit_Transaksi_Mobil_Mobil_No_Polisi_search', $editor, $this->dataset, $lookupDataset, 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Posisi_Bensin field
            //
            $editor = new TextEdit('transaksi_posisi_bensin_edit');
            $editColumn = new CustomEditColumn('Posisi Bensin (Kotak)', 'Transaksi_Posisi_Bensin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Jam field
            //
            $editor = new TextEdit('masa_sewa_jam_edit');
            $editColumn = new CustomEditColumn('Jam Sewa', 'Masa_Sewa_Jam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Hari field
            //
            $editor = new TextEdit('masa_sewa_hari_edit');
            $editColumn = new CustomEditColumn('Hari Sewa', 'Masa_Sewa_Hari', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Bulan field
            //
            $editor = new TextEdit('masa_sewa_bulan_edit');
            $editColumn = new CustomEditColumn('Bulan Sewa', 'Masa_Sewa_Bulan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Tahun field
            //
            $editor = new TextEdit('masa_sewa_tahun_edit');
            $editColumn = new CustomEditColumn('Tahun Sewa', 'Masa_Sewa_Tahun', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Kelengkapan field
            //
            $editor = new TextAreaEdit('kelengkapan_edit', 50, 8);
            $editColumn = new CustomEditColumn('Kelengkapan Kendaraan', 'Kelengkapan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Transaksi_Tanggal field
            //
            $editor = new DateTimeEdit('transaksi_tanggal_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Bayar', 'Transaksi_Tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Tangal_Waktu_Mulai field
            //
            $editor = new DateTimeEdit('tangal_waktu_mulai_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Dan Jam Keluar', 'Tangal_Waktu_Mulai', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Tanggal_Waktu_Berakhir field
            //
            $editor = new DateTimeEdit('tanggal_waktu_berakhir_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Dan Jam Masuk', 'Tanggal_Waktu_Berakhir', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Keterangan_Lainnya field
            //
            $editor = new TextAreaEdit('keterangan_lainnya_edit', 50, 8);
            $editColumn = new CustomEditColumn('Keterangan Lainnya', 'Keterangan_Lainnya', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Transaksi_Nama field
            //
            $editor = new TextEdit('transaksi_nama_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nama Tamu', 'Transaksi_Nama', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_NomorHP field
            //
            $editor = new TextEdit('transaksi_nomorhp_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nomor HP Tamu', 'Transaksi_NomorHP', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_Alamat field
            //
            $editor = new TextEdit('transaksi_alamat_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Alamat  Tamu', 'Transaksi_Alamat', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_Jaminan_Identitas field
            //
            $editor = new TextEdit('transaksi_jaminan_identitas_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Identitas yang dijaminkan', 'Transaksi_Jaminan_Identitas', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $editor = new TextEdit('transaksi_nomor_jaminan_identitas_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nomor Identitas  Tamu', 'Transaksi_Nomor_Jaminan_Identitas', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_Mobil field
            //
            $editor = new DynamicCombobox('transaksi_mobil_edit', $this->CreateLinkBuilder());
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Jenis Mobil ', 'Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'insert_Transaksi_Mobil_Mobil_No_Polisi_search', $editor, $this->dataset, $lookupDataset, 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_Posisi_Bensin field
            //
            $editor = new TextEdit('transaksi_posisi_bensin_edit');
            $editColumn = new CustomEditColumn('Posisi Bensin (Kotak)', 'Transaksi_Posisi_Bensin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Jam field
            //
            $editor = new TextEdit('masa_sewa_jam_edit');
            $editColumn = new CustomEditColumn('Jam Sewa', 'Masa_Sewa_Jam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Hari field
            //
            $editor = new TextEdit('masa_sewa_hari_edit');
            $editColumn = new CustomEditColumn('Hari Sewa', 'Masa_Sewa_Hari', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Bulan field
            //
            $editor = new TextEdit('masa_sewa_bulan_edit');
            $editColumn = new CustomEditColumn('Bulan Sewa', 'Masa_Sewa_Bulan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Masa_Sewa_Tahun field
            //
            $editor = new TextEdit('masa_sewa_tahun_edit');
            $editColumn = new CustomEditColumn('Tahun Sewa', 'Masa_Sewa_Tahun', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('0');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Kelengkapan field
            //
            $editor = new TextAreaEdit('kelengkapan_edit', 50, 8);
            $editColumn = new CustomEditColumn('Kelengkapan Kendaraan', 'Kelengkapan', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Transaksi_Tanggal field
            //
            $editor = new DateTimeEdit('transaksi_tanggal_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Bayar', 'Transaksi_Tanggal', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATETIME%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Tangal_Waktu_Mulai field
            //
            $editor = new DateTimeEdit('tangal_waktu_mulai_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Dan Jam Keluar', 'Tangal_Waktu_Mulai', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Tanggal_Waktu_Berakhir field
            //
            $editor = new DateTimeEdit('tanggal_waktu_berakhir_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Tanggal Dan Jam Masuk', 'Tanggal_Waktu_Berakhir', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Keterangan_Lainnya field
            //
            $editor = new TextAreaEdit('keterangan_lainnya_edit', 50, 8);
            $editColumn = new CustomEditColumn('Keterangan Lainnya', 'Keterangan_Lainnya', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Print field
            //
            $editor = new TextEdit('print_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Print', 'Print', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->setEnabled(false);
            $editColumn->SetInsertDefaultValue('Print');
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
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Transaksi_ID', 'Transaksi_ID', 'Transaksi ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nama_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_NomorHP_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Alamat_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Jaminan_Identitas_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'Jenis Mobil ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Posisi_Bensin field
            //
            $column = new NumberViewColumn('Transaksi_Posisi_Bensin', 'Transaksi_Posisi_Bensin', 'Posisi Bensin (Kotak)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Masa_Sewa_Jam field
            //
            $column = new NumberViewColumn('Masa_Sewa_Jam', 'Masa_Sewa_Jam', 'Jam Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Masa_Sewa_Hari field
            //
            $column = new NumberViewColumn('Masa_Sewa_Hari', 'Masa_Sewa_Hari', 'Hari Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Masa_Sewa_Bulan field
            //
            $column = new NumberViewColumn('Masa_Sewa_Bulan', 'Masa_Sewa_Bulan', 'Bulan Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Masa_Sewa_Tahun field
            //
            $column = new NumberViewColumn('Masa_Sewa_Tahun', 'Masa_Sewa_Tahun', 'Tahun Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Kelengkapan_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Transaksi_Tanggal field
            //
            $column = new DateTimeViewColumn('Transaksi_Tanggal', 'Transaksi_Tanggal', 'Tanggal Bayar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Tangal_Waktu_Mulai field
            //
            $column = new DateTimeViewColumn('Tangal_Waktu_Mulai', 'Tangal_Waktu_Mulai', 'Tanggal Dan Jam Keluar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Tanggal_Waktu_Berakhir field
            //
            $column = new DateTimeViewColumn('Tanggal_Waktu_Berakhir', 'Tanggal_Waktu_Berakhir', 'Tanggal Dan Jam Masuk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Keterangan_Lainnya_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Transaksi_ID', 'Transaksi_ID', 'Transaksi ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nama_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_NomorHP_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Alamat_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Jaminan_Identitas_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'Jenis Mobil ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Posisi_Bensin field
            //
            $column = new NumberViewColumn('Transaksi_Posisi_Bensin', 'Transaksi_Posisi_Bensin', 'Posisi Bensin (Kotak)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for Masa_Sewa_Jam field
            //
            $column = new NumberViewColumn('Masa_Sewa_Jam', 'Masa_Sewa_Jam', 'Jam Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Masa_Sewa_Hari field
            //
            $column = new NumberViewColumn('Masa_Sewa_Hari', 'Masa_Sewa_Hari', 'Hari Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Masa_Sewa_Bulan field
            //
            $column = new NumberViewColumn('Masa_Sewa_Bulan', 'Masa_Sewa_Bulan', 'Bulan Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Masa_Sewa_Tahun field
            //
            $column = new NumberViewColumn('Masa_Sewa_Tahun', 'Masa_Sewa_Tahun', 'Tahun Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Kelengkapan_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Transaksi_Tanggal field
            //
            $column = new DateTimeViewColumn('Transaksi_Tanggal', 'Transaksi_Tanggal', 'Tanggal Bayar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for Tangal_Waktu_Mulai field
            //
            $column = new DateTimeViewColumn('Tangal_Waktu_Mulai', 'Tangal_Waktu_Mulai', 'Tanggal Dan Jam Keluar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Tanggal_Waktu_Berakhir field
            //
            $column = new DateTimeViewColumn('Tanggal_Waktu_Berakhir', 'Tanggal_Waktu_Berakhir', 'Tanggal Dan Jam Masuk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Keterangan_Lainnya_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Transaksi_ID field
            //
            $column = new NumberViewColumn('Transaksi_ID', 'Transaksi_ID', 'Transaksi ID', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nama_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_NomorHP_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Alamat_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Jaminan_Identitas_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Mobil_No_Polisi field
            //
            $column = new TextViewColumn('Transaksi_Mobil', 'Transaksi_Mobil_Mobil_No_Polisi', 'Jenis Mobil ', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Posisi_Bensin field
            //
            $column = new NumberViewColumn('Transaksi_Posisi_Bensin', 'Transaksi_Posisi_Bensin', 'Posisi Bensin (Kotak)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Masa_Sewa_Jam field
            //
            $column = new NumberViewColumn('Masa_Sewa_Jam', 'Masa_Sewa_Jam', 'Jam Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Masa_Sewa_Hari field
            //
            $column = new NumberViewColumn('Masa_Sewa_Hari', 'Masa_Sewa_Hari', 'Hari Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Masa_Sewa_Bulan field
            //
            $column = new NumberViewColumn('Masa_Sewa_Bulan', 'Masa_Sewa_Bulan', 'Bulan Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Masa_Sewa_Tahun field
            //
            $column = new NumberViewColumn('Masa_Sewa_Tahun', 'Masa_Sewa_Tahun', 'Tahun Sewa', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Kelengkapan_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Transaksi_Tanggal field
            //
            $column = new DateTimeViewColumn('Transaksi_Tanggal', 'Transaksi_Tanggal', 'Tanggal Bayar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Tangal_Waktu_Mulai field
            //
            $column = new DateTimeViewColumn('Tangal_Waktu_Mulai', 'Tangal_Waktu_Mulai', 'Tanggal Dan Jam Keluar', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Tanggal_Waktu_Berakhir field
            //
            $column = new DateTimeViewColumn('Tanggal_Waktu_Berakhir', 'Tanggal_Waktu_Berakhir', 'Tanggal Dan Jam Masuk', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('transaksiGrid_Keterangan_Lainnya_handler_compare');
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
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(true);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
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
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setUseModalMultiEdit(true);
            $result->setTableBordered(false);
            $result->setTableCondensed(true);
            
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
            $detailPage = new transaksi_laporanPage('transaksi_laporan', $this, array('Laporan_Transaksi'), array('Transaksi_ID'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('transaksi.laporan'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('transaksi.laporan'));
            $detailPage->SetTitle('Laporan');
            $detailPage->SetMenuLabel('Laporan');
            $detailPage->SetHeader(GetPagesHeader());
            $detailPage->SetFooter(GetPagesFooter());
            $detailPage->SetHttpHandlerName('transaksi_laporan_handler');
            $handler = new PageHTTPHandler('transaksi_laporan_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new transaksi_mobilPage('transaksi_mobil', $this, array('Mobil_id'), array('Transaksi_Mobil'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('transaksi.mobil'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('transaksi.mobil'));
            $detailPage->SetTitle('Mobil');
            $detailPage->SetMenuLabel('Mobil');
            $detailPage->SetHeader(GetPagesHeader());
            $detailPage->SetFooter(GetPagesFooter());
            $detailPage->SetHttpHandlerName('transaksi_mobil_handler');
            $handler = new PageHTTPHandler('transaksi_mobil_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nama_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_NomorHP_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Alamat_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Jaminan_Identitas_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Kelengkapan_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Keterangan_Lainnya_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Print field
            //
            $column = new TextViewColumn('Print', 'Print', 'Print', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('print.php?id=%Transaksi_ID%');
            $column->setTarget('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Print_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nama_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_NomorHP_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Alamat_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Jaminan_Identitas_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Kelengkapan_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Keterangan_Lainnya_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nama_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_NomorHP_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Alamat_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Jaminan_Identitas_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Kelengkapan_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Keterangan_Lainnya_handler_compare', $column);
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_Transaksi_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_Transaksi_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nama field
            //
            $column = new TextViewColumn('Transaksi_Nama', 'Transaksi_Nama', 'Nama Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nama_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_NomorHP field
            //
            $column = new TextViewColumn('Transaksi_NomorHP', 'Transaksi_NomorHP', 'Nomor HP Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_NomorHP_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Alamat field
            //
            $column = new TextViewColumn('Transaksi_Alamat', 'Transaksi_Alamat', 'Alamat  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Alamat_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Jaminan_Identitas', 'Transaksi_Jaminan_Identitas', 'Identitas yang dijaminkan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Jaminan_Identitas_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Transaksi_Nomor_Jaminan_Identitas field
            //
            $column = new TextViewColumn('Transaksi_Nomor_Jaminan_Identitas', 'Transaksi_Nomor_Jaminan_Identitas', 'Nomor Identitas  Tamu', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Transaksi_Nomor_Jaminan_Identitas_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Kelengkapan field
            //
            $column = new TextViewColumn('Kelengkapan', 'Kelengkapan', 'Kelengkapan Kendaraan', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Kelengkapan_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Keterangan_Lainnya field
            //
            $column = new TextViewColumn('Keterangan_Lainnya', 'Keterangan_Lainnya', 'Keterangan Lainnya', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Keterangan_Lainnya_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Print field
            //
            $column = new TextViewColumn('Print', 'Print', 'Print', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('print.php?id=%Transaksi_ID%');
            $column->setTarget('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'transaksiGrid_Print_handler_view', $column);
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_Transaksi_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
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
                    new StringField('Mobil_Warna')
                )
            );
            $lookupDataset->setOrderByField('Mobil_No_Polisi', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_Transaksi_Mobil_Mobil_No_Polisi_search', 'Mobil_id', 'Mobil_No_Polisi', '%Mobil_No_Polisi% %Mobil_Tipe%', 20);
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
        $Page = new transaksiPage("transaksi", "transaksi.php", GetCurrentUserPermissionSetForDataSource("transaksi"), 'UTF-8');
        $Page->SetTitle('Transaksi');
        $Page->SetMenuLabel('Transaksi');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("transaksi"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
