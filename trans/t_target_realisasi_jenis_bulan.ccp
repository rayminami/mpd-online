<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="726" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_target_realisasi_jenis_bulanForm" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" actionPage="t_target_realisasi" errorSummator="Error" wizardFormMethod="post" PathID="t_target_realisasi_jenis_bulanForm" connection="ConnSIKP" activeCollection="SQLParameters" dataSource="SELECT * 
FROM v_revenue_target_vs_realisasi_month
WHERE t_revenue_target_id = {t_revenue_target_id}" parameterTypeListName="ParameterTypeList">
			<Components>
				<Hidden id="731" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFormp_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="886" fieldSourceType="DBColumn" dataType="Text" name="t_revenue_target_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFormt_revenue_target_id" fieldSource="t_revenue_target_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="928" fieldSourceType="DBColumn" dataType="Text" name="p_vat_group_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFormp_vat_group_id" fieldSource="p_vat_group_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="890"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="884" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_year_period_id"/>
				<TableParameter id="885" conditionType="Parameter" useIsNull="False" field="p_vat_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_vat_type_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="889" parameterType="URL" variable="t_revenue_target_id" dataType="Float" DBFormat="0" parameterSource="t_revenue_target_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="12" connection="ConnSIKP" name="t_target_realisasiGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT
	MAX(p_finance_period_id) as p_finance_period_id,
	MAX(p_year_period_id) as p_year_period_id,
	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,
	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,
	MAX(p_vat_type_id) as p_vat_type_id,
	MAX(bulan) as bulan,
	ROUND(SUM (target_amount)) as target_amount,
	ROUND(SUM (realisasi_amt)) as realisasi_amt,
	MAX (penalty_amt) as penalty_amt,
	ROUND(SUM (debt_amt)) as debt_amt,
	MAX (denda_pokok) as denda_pokok,
	MAX (denda_piutang) as denda_piutang
FROM
	f_target_vs_real_monthly_new3_mark_ii(
	{p_year_period_id},{p_vat_type_id}
	)
GROUP BY p_finance_period_id

ORDER BY MAX(start_date) ASC">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="bulan" fieldSource="bulan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasiGridbulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="679" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtarget_amount" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="750" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpercentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="893" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddebt_amt" fieldSource="debt_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="676" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridrealisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="894" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtotal_amt" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="895" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="896" fieldSourceType="DBColumn" dataType="Text" name="start_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridstart_date" fieldSource="start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="897" fieldSourceType="DBColumn" dataType="Text" name="end_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridend_date" fieldSource="end_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="690" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridDLink" hrefSource="t_target_realisasi_jenis_bulan.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="691" sourceType="DataField" format="yyyy-mm-dd" name="p_finance_period_id" source="p_finance_period_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="876" fieldSourceType="CodeExpression" dataType="Float" html="False" name="target_amount_sum" PathID="t_target_realisasiGridtarget_amount_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="877" fieldSourceType="CodeExpression" dataType="Float" html="False" name="realisasi_amt_sum" PathID="t_target_realisasiGridrealisasi_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="921" fieldSourceType="CodeExpression" dataType="Float" html="False" name="penalty_amt_sum" PathID="t_target_realisasiGridpenalty_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="929" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_pokok" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_pokok" fieldSource="denda_pokok" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="930" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_piutang" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_piutang" fieldSource="denda_piutang" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="931" fieldSourceType="DBColumn" dataType="Float" html="False" name="penalty_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpenalty_amt" fieldSource="penalty_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="932" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_pokok2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_pokok2" fieldSource="denda_pokok" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="933" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_piutang1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_piutang1" fieldSource="denda_piutang" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="934" fieldSourceType="CodeExpression" dataType="Float" html="False" name="penalty_amt_sum1" PathID="t_target_realisasiGridpenalty_amt_sum1" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="922" fieldSourceType="CodeExpression" dataType="Float" html="False" name="debt_amt_sum" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddebt_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="927" fieldSourceType="CodeExpression" dataType="Float" html="False" name="total_amt_sum" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtotal_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="878" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_sum" PathID="t_target_realisasiGridpercentage_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="725" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="735" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="695" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="677" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="898" variable="p_vat_type_id" parameterType="URL" dataType="Text" parameterSource="p_vat_type_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="900" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="12" connection="ConnSIKP" name="t_target_realisasiGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="(SELECT
	MAX(target.p_finance_period_id) as p_finance_period_id,
	MAX(target.p_year_period_id) as p_year_period_id,
	to_char(MAX(target.start_date),'dd-mm-yyyy') as start_date,
	to_char(MAX(target.end_date),'dd-mm-yyyy') as end_date,
	MAX(target.p_vat_type_id) as p_vat_type_id,
	MAX(target.bulan) as bulan,
	ROUND(SUM (target.target_amount)) as target_amount,
	ROUND(SUM (target.realisasi_amt)) as realisasi_amt,
	ROUND(SUM (target.penalty_amt)) as penalty_amt,
	ROUND(SUM (target.debt_amt)) as debt_amt,
	MAX(dtl.vat_code) as ayat
FROM
	f_target_vs_real_monthly_new3_mark_ii({p_year_period_id},{p_vat_type_id}) target,
	p_vat_type_dtl dtl
WHERE
	dtl.p_vat_type_dtl_id = target.p_vat_type_dtl_id
	AND (target.p_finance_period_id = {p_finance_period_id} or {p_finance_period_id} is null)
GROUP BY target.p_vat_type_dtl_id

ORDER BY MAX(dtl.vat_code) ASC)
UNION
(select 999,
	{p_year_period_id},
	'',
	'',
	0,
	'',
	0,
	f_get_total_denda_ayat_mod_1({p_year_period_id},{p_finance_period_id},{p_vat_type_id}) as jumlah,
	0,
	0,
	'DENDA')">
			<Components>
				<Navigator id="901" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="902" fieldSourceType="DBColumn" dataType="Text" html="False" name="ayat" fieldSource="ayat" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasiGrid1ayat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="903" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1target_amount" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="904" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1p_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="905" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1percentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="907" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1debt_amt" fieldSource="debt_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="908" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1realisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="909" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1total_amt" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="910" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1p_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="911" fieldSourceType="DBColumn" dataType="Text" name="start_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1start_date" fieldSource="start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="912" fieldSourceType="DBColumn" dataType="Text" name="end_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1end_date" fieldSource="end_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="915" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="916" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="917" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="918" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="919" variable="p_vat_type_id" parameterType="URL" dataType="Text" parameterSource="p_vat_type_id" defaultValue="null"/>
				<SQLParameter id="920" variable="p_finance_period_id" parameterType="URL" defaultValue="'null'" dataType="Text" parameterSource="p_finance_period_id" designDefaultValue="null"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_bulan.php" forShow="True" url="t_target_realisasi_jenis_bulan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="899"/>
			</Actions>
		</Event>
	</Events>
</Page>
