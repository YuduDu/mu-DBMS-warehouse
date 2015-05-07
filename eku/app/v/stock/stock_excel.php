<Table ss:ExpandedColumnCount="5" ss:ExpandedRowCount="11" x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="54" ss:DefaultRowHeight="13.5">
   <Row>
    <Cell ss:StyleID="s62"><Data ss:Type="String">Inbound ID</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">Create Time</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">Supplier</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">Deliverer</Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String">Approver</Data></Cell>

   </Row>
<?if(is_array($records )){foreach ($records as $r ){ ?>
  <Row>
    <Cell ss:StyleID="s62"><Data ss:Type="String"><?=$r['Inbound_id']?></Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String"><?=$r['CreateTime']?></Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String"><?=$r['Suppliers_Sid']?></Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String"><?=$r['Deliverer']?></Data></Cell>
    <Cell ss:StyleID="s62"><Data ss:Type="String"><?=$r['Approver_id']?></Data></Cell>
   </Row>
   
<?  }
}?>
</Table>
