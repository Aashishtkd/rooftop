function deleteFunction(del_id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "route('admin.blog.destroy')",
                type : "POST",
                cache:false,
                data: {"id" : id},
                contentType : false, // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType:'json',
                success : function(data){
                    console.log(data);
                    // loadtable();
                    if(data.status ==200){
                        loadtable();
                        Command: toastr["success"]("Success", "Blog Deleted Sucessfully");
                    }else{
                    // $('.error_list').text('error occurs.')
                        Command: toastr["error"]("Failed", "Unable to delete");
                    }
                    $("#exampleModalLive").modal('hide');
                }
                });
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
}