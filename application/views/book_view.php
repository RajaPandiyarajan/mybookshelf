<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bookshelf
    </title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/common/css/rating.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>My Bookshelf
      </h1>
      </center>    
    <br />
    <button class="btn btn-success" onclick="add_book()">
      <i class="glyphicon glyphicon-plus">
      </i> Add Book
    </button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Book ID
          </th>
          <th>Book ISBN
          </th>
          <th>Book Title
          </th>
          <th>Book Author
          </th>
          <th>Book Category
          </th>
          <th>Book Rating
          </th>
          <th style="width:125px;">Action
        </p>
        </th>
      </tr>
    </thead>
  <tbody>
    <?php 
$i=0;
foreach($books as $book){?>
    <tr>
      <td>
        <?php echo $book->book_id;?>
      </td>
      <td>
        <?php echo $book->book_isbn;?>
      </td>
      <td>
        <?php echo $book->book_title;?>
      </td>
      <td>
        <?php echo $book->book_author;?>
      </td>
      <td>
        <?php echo $book->book_category;?>
      </td>
      <td>
        <input name="<?php echo "rating_".$i;?>" value="<?php echo $book->rating_number; ?>" id="<?php echo "rating_star_".$i;?>" type="hidden" book_id= <?php echo $book->book_id;?>	 />				  
        <div class="overall-rating">
          (Average Rating 
          <span id="avgrat_<?php echo $book->book_id;?>">
            <?php echo $book->average_rating; ?>
          </span> Based on 
          <span id="totalrat_<?php echo $book->book_id;?>">
            <?php echo $book->rating_number ; ?>
          </span>  rating)
        </div>
      </td>
      <td>
        <button class="btn btn-warning" onclick="edit_book(<?php echo $book->book_id;?>)">
          <i class="glyphicon glyphicon-pencil">
          </i>
        </button>
        <button class="btn btn-danger" onclick="delete_book(<?php echo $book->book_id;?>)">
          <i class="glyphicon glyphicon-remove">
          </i>
        </button>
      </td>
    </tr>
    <?php 
$i++;	 
}?>
  </tbody>
  </table>
</div>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>">
</script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>">
</script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>">
</script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>">
</script>
<script src="<?php echo base_url('assets/common/js/rating.js')?>">
</script>
<script type="text/javascript">
  $(document).ready( function () {
    var total_rating =<?php echo $i?>;
    if(total_rating >0) {
      for(var i=0;i<=<?php echo $i?>-1;i++)	{
		  var dynamicStar = $("#rating_star_"+i).val();
        $("#rating_star_"+i).rating_widget({
          starLength: '5',
          initialValue: dynamicStar,
          callbackFunctionName: 'processRating',
          imageDirectory: 'assets/common/images/',
          inputAttr: 'book_id'
        }
                                          );
      }
    }
    $('#table_id').DataTable();
  }
                   );
  var save_method;
  //for save method string
  var table;
  function add_book()
  {
    save_method = 'add';
    $('#form')[0].reset();
    // reset form on modals
    $('#modal_form').modal('show');
    // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
  }
  function edit_book(id)
  {
    save_method = 'update';
    $('#form')[0].reset();
    // reset form on modals
    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('book/ajax_edit/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="book_id"]').val(data.book_id);
        $('[name="book_isbn"]').val(data.book_isbn);
        $('[name="book_title"]').val(data.book_title);
        $('[name="book_author"]').val(data.book_author);
        $('[name="book_category"]').val(data.book_category);
        $('#modal_form').modal('show');
        // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Book');
        // Set title to Bootstrap modal title
      }
      ,
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data from ajax');
      }
    }
          );
  }
  function save()
  {
    var url;
    if(save_method == 'add')
    {
      url = "<?php echo site_url('book/book_add')?>";
    }
    else
    {
      url = "<?php echo site_url('book/book_update')?>";
    }
    // ajax adding data to database
    $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data)
      {
        //if success close modal and reload ajax table
        $('#modal_form').modal('hide');
        location.reload();
        // for reload a page
      }
      ,
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error adding / update data');
      }
    }
          );
  }
  function delete_book(id)
  {
    if(confirm('Are you sure delete this data?'))
    {
      // ajax delete data from database
      $.ajax({
        url : "<?php echo site_url('book/book_delete')?>/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          location.reload();
        }
        ,
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error deleting data');
        }
      }
            );
    }
  }
  function processRating(val, attrVal){
    $.ajax({
      url : "<?php echo site_url('book/book_rating')?>/"+attrVal+"/"+val,
      type: 'POST',      
      dataType: 'JSON',
      success : function(data) {			
			
         if (data.status == true) {
          $('#avgrat_'+attrVal).text(data.result.average_rating);
				$('#totalrat_'+attrVal).text(data.result.rating_number);
          
        }
        else{
          alert('Some problem occured, please try again.');
        } 
      }
      ,
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert(textStatus+'Error updating rating'+errorThrown);
      }
    }
          );
  }
</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
        <h3 class="modal-title">Book Form
        </h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="book_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Book ISBN
              </label>
              <div class="col-md-9">
                <input name="book_isbn" placeholder="Book ISBN" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Book Title
              </label>
              <div class="col-md-9">
                <input name="book_title" placeholder="Book_title" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Book Author
              </label>
              <div class="col-md-9">
                <input name="book_author" placeholder="Book Author" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Book Category
              </label>
              <div class="col-md-9">
                <input name="book_category" placeholder="Book Category" class="form-control" type="text">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>
