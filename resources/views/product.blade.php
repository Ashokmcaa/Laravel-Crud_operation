@extends('layouts.app')
<style>
   #imageList{
   display: flex;
   }
   #imageList_edit{
   display: flex;
   }
   #table-container {
   width: 100%; 
   overflow: auto;
   max-height: 400px;
   }

  
</style>
@section('content')
<div class="container">
   <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#exampleModal">
   Add Product
   </button>
   <div style="overflow: overlay;">
      <table id="example" class="display" style="width:100%">
         <thead>
            <tr>
               <th>product name</th>
               <th>unit type</th>
               <th>product category</th>
               {{-- <th>product images.</th> --}}
               <th>product price</th>
               <th>discount percentage</th>
               <th> discount amount </th>
               <th>  Discount range dates</th>
               <th> Tax percentage </th>
               <th> Tax amount </th>
               @if(Auth::user()->roleedit==1 || Auth::user()->roledelete==1)
               <th> Action </th>
               @endif
            </tr>
         </thead>
      </table>
   </div>
</div>
{{-- add modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form id="addproduct" action="">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <label for="product_name" class="font-weight-bold">Product Name :</label>
                     <input type="text" required name="product_name" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="unit_type" class="font-weight-bold">Unit Type :</label>
                     <select required name="unit_type" class="form-control">
                        <option value="">--Select--</option>
                        <option value="Qty">Qty</option>
                        <option value="Ltr">Ltr</option>
                        <option value="KG">KG</option>
                        <option value="Meter">Meter</option>
                     </select>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="product_category" class="font-weight-bold">Product Category :</label>
                     <input type="text" required name="product_category" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="product_images" class="font-weight-bold">Product Images :</label>
                     <input type="file" required name="product_images[]" id="image_upload" multiple class="form-control">
                     <div id="imageList">
                     </div>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="product_price" class="font-weight-bold">Product Price :</label>
                     <input type="number" required name="product_price" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="discount_percentage " class="font-weight-bold">Discount Percentage  :</label>
                     <input type="number" required name="discount_percentage" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="discount_amount " class="font-weight-bold">Discount Amount  :</label>
                     <input type="number" required name="discount_amount" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="discount_range_dates " class="font-weight-bold">Discount Range Dates  :</label>
                     <input type="date" required name="discount_range_dates" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="tax_percentage " class="font-weight-bold">Tax Percentage  :</label>
                     <input type="number" required name="tax_percentage" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="tax_amount " class="font-weight-bold">Tax Amount  :</label>
                     <input type="number" required name="tax_amount" class="form-control">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- edit modal --}}
@if(Auth::user()->roleedit==1)
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form id="editproduct" action="">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <label for="product_name" class="font-weight-bold">Product Name :</label>
                     <input type="text" required name="product_name" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="unit_type" class="font-weight-bold">Unit Type :</label>
                     <select required name="unit_type" class="form-control">
                        <option value="">--Select--</option>
                        <option value="Qty">Qty</option>
                        <option value="Ltr">Ltr</option>
                        <option value="KG">KG</option>
                        <option value="Meter">Meter</option>
                     </select>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="product_category" class="font-weight-bold">Product Category :</label>
                     <input type="text" required name="product_category" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="product_images" class="font-weight-bold">Product Images :</label>
                     <input type="file" name="product_images[]" id="image_edit" multiple class="form-control">
                     <div id="imageList_edit">
                     </div>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="product_price" class="font-weight-bold">Product Price :</label>
                     <input type="number" required name="product_price" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="discount_percentage " class="font-weight-bold">Discount Percentage  :</label>
                     <input type="number" required name="discount_percentage" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="discount_amount " class="font-weight-bold">Discount Amount  :</label>
                     <input type="number" required name="discount_amount" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="discount_range_dates " class="font-weight-bold">Discount Range Dates  :</label>
                     <input type="date" required name="discount_range_dates" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="tax_percentage " class="font-weight-bold">Tax Percentage  :</label>
                     <input type="number" required name="tax_percentage" class="form-control">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="tax_amount " class="font-weight-bold">Tax Amount  :</label>
                     <input type="number" required name="tax_amount" class="form-control">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" required name="edit_id">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endif
{{-- edit modal --}}
@if(Auth::user()->roledelete==1)
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form id="deleteModal" action="">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               Do you want delete this Product...?
            </div>
            <div class="modal-footer">
               <input type="hidden" required name="delete_id">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
   function show_value(){
   
   
   
       // $.ajax({
       //         type: "get",
       //         url: "/api/show_value",
       //         success: function(data) {
                     
   
       //         }
       //     });
   
   
   
   }
   
   
   $(document).ready(function () {
       var table; // Declare the DataTable variable
   
       $.ajax({
           type: "GET",
           url: "/api/show_value",
           success: function (data) {
               table = new DataTable('#example', {
                   data: data,
                   columns: [
                       { data: 'product_name' },
                       { data: 'unit_type' },
                       { data: 'product_category' },
                    //    { data: 'product_images' },
                       { data: 'product_price' },
                       { data: 'discount_percentage' },
                       { data: 'discount_amount' },
                       { data: 'discount_range_dates' },
                       { data: 'tax_percentage' },
                       { data: 'tax_amount' },
                       @if(Auth::user()->roleedit==1 || Auth::user()->roledelete==1)
                       {
                           data: null,
                           render: function (data, type, full, meta) {
                               return '<button class="btn btn-success edit-button drop-shadow btn-sm border-radius-50 btn-sm mr-2 datatableUpdate" data-updateId="' + data.id + '" data-toggle="tooltip" data-placement="top" title="Edit">Edit</button>  <button class="btn btn-danger delete-button drop-shadow border-radius-50 btn-sm datatableDelete" data-deleteId="' + data.id + '" data-toggle="tooltip" data-placement="top" title="Delete">Delete</button>';
                           }
                       }
                       @endif
                   ]
               });
           },
           error: function (xhr, status, error) {
               console.error('AJAX request error:', status, error);
           }
       });
   
       $('#example').on('click', '.edit-button', function () {
        $('#imageList_edit').empty();
           var rowData = table.row($(this).closest('tr')).data();
           $('#editModal').modal('show');
       $("input[name='product_name']").val(rowData.product_name);
       $("select[name='unit_type']").val(rowData.unit_type);
       $("input[name='product_category']").val(rowData.product_category);
       $("input[name='product_images']").val(rowData.product_images);
       $("input[name='product_price']").val(rowData.product_price);
       $("input[name='discount_percentage']").val(rowData.discount_percentage);
       $("input[name='discount_amount']").val(rowData.discount_amount);
       $("input[name='discount_range_dates']").val(rowData.discount_range_dates);
       $("input[name='tax_percentage']").val(rowData.tax_percentage);
       $("input[name='tax_amount']").val(rowData.tax_amount);
       $("input[name='edit_id']").val(rowData.id);
       var jsonObject = JSON.parse(rowData.product_images);
   var imagesContainer = $('#imageList_edit');
   
   var domainURL = window.location.href;
   var url = new URL(domainURL);
   var baseURL = url.origin;
   
   for (var key in jsonObject) {
       if (jsonObject.hasOwnProperty(key)) {
           var element = jsonObject[key];
           var thumbnail = $('<div class="image_size"></div>');
           thumbnail.append('<img width="70" height="70" src="'+baseURL+'/image/'+ element +'">');
           imagesContainer.append(thumbnail);
       }
   }
   
       console.log(jsonObject);
   
   
       });
       $('#example').on('click', '.delete-button', function () {
           var rowData = table.row($(this).closest('tr')).data();
           $('#deleteModal').modal('show');
       $("input[name='delete_id']").val(rowData.id);
          
       });
   });
   
   
       $(document).ready(function(){
   
   
   // add value 
   
           $('#addproduct').on('submit', function (event) {
           event.preventDefault();
           let form = new FormData($('#addproduct')[0]);
           console.log(form);
   
           $.ajax({
               type: "post",
               url: "/api/create",
               data: form,
               processData: false,
               contentType: false,
               cache: false,
               dataType: "JSON",
               enctype: "multipart/form-data",
               success: function(data) {
                   if(data.success){
                  alert(data.message);
                   $('#exampleModal').modal('hide');
                   }else{
                       // alert(data.message);
                   }
   
               }
           });
       });
   
   
   
   
   // edit value 
   
   
   $('#editproduct').on('submit', function (event) {
           event.preventDefault();
           let form = new FormData($('#editproduct')[0]);
           console.log(form);
   
           $.ajax({
               type: "post",
               url: "/api/product_edit",
               data: form,
               processData: false,
               contentType: false,
               cache: false,
               dataType: "JSON",
               enctype: "multipart/form-data",
               success: function(data) {
                   if(data.success){
                  alert(data.message);
           $('#editModal').modal('hide');

                   $('#exampleModal').modal('hide');
                   }else{
                       alert(data.message);
                   }
   
               }
           });
       });
   
       $('#deleteModal').on('submit', function (event) {
           event.preventDefault();
           // let form = new FormData($('#deleteModal')[0]);
           // console.log(form);
   
           var id =$("input[name='delete_id']").val();
   
           $.ajax({
               type: "post",
               url: "/api/product_delete",
               data: {
                   delete_id:id
               },
               dataType: "JSON",
               success: function(data) {
                   if(data.success){
                  alert(data.message);
                   $('#deleteModal').modal('hide');
                   }else{
                       alert(data.message);
                   }
   
               }
           });
       });
   
   
   
   
   
       $('#image_upload').on('change', function () {
               var imagesContainer = $('#imageList');
               var maxImages = 3;
   
               if (this.files.length > maxImages) {
                   alert('You can only select a maximum of ' + maxImages + ' images.');
                   clearFileInput(this);
                   return;
               }
   
               imagesContainer.empty();
   
               for (var i = 0; i < this.files.length; i++) {
                   var file = this.files[i];
                   var reader = new FileReader();
   
                   reader.onload = function (e) {
                       var thumbnail = $('<div class="image_size"></div>');
                       thumbnail.append('<img width="70" height="70" src="' + e.target.result + '">');
                       imagesContainer.append(thumbnail);
                   }
   
                   reader.readAsDataURL(file);
               }
           });
   
   
   $('#image_edit').on('change', function () {
               var imagesContainer = $('#imageList_edit');
               var maxImages = 3;
   
               if (this.files.length > maxImages) {
                   alert('You can only select a maximum of ' + maxImages + ' images.');
                   clearFileInput(this);
                   return;
               }
   
               imagesContainer.empty();
   
               for (var i = 0; i < this.files.length; i++) {
                   var file = this.files[i];
                   var reader = new FileReader();
   
                   reader.onload = function (e) {
                       var thumbnail = $('<div class="image_size"></div>');
                       thumbnail.append('<img width="70" height="70" src="' + e.target.result + '">');
                       imagesContainer.append(thumbnail);
                   }
   
                   reader.readAsDataURL(file);
               }
           });
   
   });
   function clearFileInput(input) {
           // Clear the selected files from the file input
           if (input.files) {
               input.value = '';
           }
       }
</script>
@endsection