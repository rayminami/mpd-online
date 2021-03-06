<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_rqst_type_doc_type_mapGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="SELECT
a.code,
b.p_rqst_type_doc_type_map_id,
b.description,
to_char(b.creation_date,'DD-MON-YYYY') as creation_date,
b.created_by,
to_char(b.updated_date,'DD-MON-YYYY') as updated_date,
b.updated_by,
c.display_name
FROM (p_rqst_type_doc_type_map b INNER JOIN p_rqst_type a ON
b.p_rqst_type_id = a.p_rqst_type_id) INNER JOIN p_document_type c ON
b.p_document_type_id = c.p_document_type_id 

WHERE display_name LIKE '%{s_keyword}%'
OR code LIKE '%{s_keyword}%' " parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_rqst_type_doc_type_map.ccp" removeParameters="p_rqst_type_doc_type_map_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_rqst_type_doc_type_map.ccp" wizardThemeItem="GridA" PathID="p_rqst_type_doc_type_mapGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="122" sourceType="DataField" name="p_rqst_type_doc_type_map_id" source="p_rqst_type_doc_type_map_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_rqst_type_doc_type_mapGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_rqst_type_doc_type_mapGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_by" fieldSource="updated_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_rqst_type_doc_type_mapGridupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_date" fieldSource="updated_date" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_rqst_type_doc_type_mapGridupdated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_rqst_type_doc_type_map_id" fieldSource="p_rqst_type_doc_type_map_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_rqst_type_doc_type_mapGridp_rqst_type_doc_type_map_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="160" fieldSourceType="DBColumn" dataType="Text" html="False" name="display_name" fieldSource="display_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_rqst_type_doc_type_mapGriddisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="124"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="170" conditionType="Parameter" useIsNull="False" field="display_name" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
<TableParameter id="171" conditionType="Parameter" useIsNull="False" field="code" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="159" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_rqst_type_doc_type_mapSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_rqst_type_doc_type_map.ccp" PathID="p_rqst_type_doc_type_mapSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_rqst_type_doc_type_mapSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_rqst_type_doc_type_mapSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_rqst_type_doc_type_mapForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_rqst_type_doc_type_mapForm" customDeleteType="SQL" activeCollection="DSQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_rqst_type_doc_type_map(p_rqst_type_doc_type_map_id, p_rqst_type_id, p_document_type_id, description, creation_date, created_by, updated_date, updated_by) 
VALUES(generate_id('sikp','p_rqst_type_doc_type_map','p_rqst_type_doc_type_map_id'), {p_rqst_type_id}, {p_document_type_id}, '{description}', sysdate, '{created_by}', sysdate, '{updated_by}')" customInsertType="SQL" dataSource="SELECT
a.code,
b.p_rqst_type_doc_type_map_id,
b.description,
to_char(b.creation_date,'DD-MON-YYYY') as creation_date,
b.created_by,
to_char(b.updated_date,'DD-MON-YYYY') as updated_date,
b.updated_by,
c.display_name
FROM (p_rqst_type_doc_type_map b INNER JOIN p_rqst_type a ON
b.p_rqst_type_id = a.p_rqst_type_id) INNER JOIN p_document_type c ON
b.p_document_type_id = c.p_document_type_id 

WHERE
p_rqst_type_doc_type_map_id = {p_rqst_type_doc_type_map_id}" customUpdate="UPDATE p_rqst_type_doc_type_map SET
p_rqst_type_id = {p_rqst_type_id},
p_document_type_id = {p_document_type_id}, 
description = '{description}', 
updated_date = sysdate, 
updated_by = '{updated_by}'
WHERE
p_rqst_type_doc_type_map_id = {p_rqst_type_doc_type_map_id}" activeTableType="customUpdate" customDelete="DELETE FROM p_rqst_type_doc_type_map 
WHERE  p_rqst_type_doc_type_map_id = {p_rqst_type_doc_type_map_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_rqst_type_doc_type_mapFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_rqst_type_doc_type_mapFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_rqst_type_doc_type_mapFormButton_Delete" removeParameters="FLAG;p_rqst_type_id;p_rqst_typeGridPage;s_keyword">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_rqst_type_doc_type_mapFormButton_Cancel" removeParameters="FLAG;p_rqst_type_id;p_rqst_typeGridPage;s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" fieldSource="p_rqst_type_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Jenis Permohonan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" name="p_rqst_typeGridPage" PathID="p_rqst_type_doc_type_mapFormp_rqst_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="150" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="display_name" fieldSource="display_name" caption="Jenis Pajak" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_rqst_type_doc_type_mapFormdisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="151" fieldSourceType="DBColumn" dataType="Float" name="p_document_type_id" PathID="p_rqst_type_doc_type_mapFormp_document_type_id" fieldSource="p_document_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="174" fieldSourceType="DBColumn" dataType="Text" name="p_rqst_type_doc_type_map_id" PathID="p_rqst_type_doc_type_mapFormp_rqst_type_doc_type_map_id" fieldSource="p_rqst_type_doc_type_map_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
			</Events>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="157" variable="p_rqst_type_doc_type_map_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_rqst_type_doc_type_map_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="106" fieldName="to_char(b.updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="141" fieldName="to_char(b.creation_date,'DD-MON-YYYY')" isExpression="True" alias="creation_date"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="85" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="87" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="89" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="148" variable="p_rqst_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_rqst_type_id"/>
				<SQLParameter id="172" variable="p_document_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_document_type_id"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="133" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="134" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="135" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="136" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="137" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="138" field="to_char(updated_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="139" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="62" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="131" variable="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id" defaultValue="0"/>
				<SQLParameter id="149" variable="p_document_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_document_type_id"/>
				<SQLParameter id="173" variable="p_rqst_type_doc_type_map_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_rqst_type_doc_type_map_id"/>
</USQLParameters>
			<UConditions>
				<TableParameter id="126" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_rqst_type_id"/>
				<TableParameter id="127" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="p_rqst_type_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="49" field="code" dataType="Text" parameterType="Control" parameterSource="code" omitIfEmpty="True"/>
				<CustomParameter id="53" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="56" field="updated_date" dataType="Date" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="57" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="69" field="creation_date" dataType="Date" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="70" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="125" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="108" variable="p_rqst_type_doc_type_map_id" parameterType="Control" dataType="Float" parameterSource="p_rqst_type_doc_type_map_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="132" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" parameterType="URL" parameterSource="p_rqst_type_id" searchConditionType="Equal" logicOperator="And"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_rqst_type_doc_type_map_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_rqst_type_doc_type_map.php" forShow="True" url="p_rqst_type_doc_type_map.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
