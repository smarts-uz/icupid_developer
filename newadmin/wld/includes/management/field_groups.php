<ul class="form">
  
  <div class="content">
    
    <div class="box">
      <div class="box-content">
        <div id="contentcolumn" class="contentcolumndash">
          <br class="clear">
          <div class="bar_save">
            <input type="button" value="Add New Field" class="MainBtn" onClick="javascript:location.href='?p=management&sp=manage_add_fields&market_id=<?=$_GET['market_id']?>'"/>
            <input type="button" value="Add Group" class="MainBtn" onClick="javascript:location.href='?p=management&sp=manage_add_groups&market_id=<?=$_GET['market_id']?>'"/>
            <br class="clear">
          </div>
          <br class="clear">
          <input type="hidden" id="select-market" name="market_id" value="<?=$_REQUEST['market_id']?>"/>
          <div id="TableViewer"></div> 
        </div>
        <br class="clear">
      </div>
    </div>
  </div>

</ul>