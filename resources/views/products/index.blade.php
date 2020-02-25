@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Barscantechnologies.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered" id="example">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST" id="form{{$product->id}}">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
                    <!--<button type="submit" class="btn btn-danger">Delete</button>-->
                    <button type="submit" class="btn btn-danger delete" data-value="{{$product->id}}">Delete</button>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $(".delete").click(function(e){
                                e.preventDefault();
                                console.log('helo');
                                    swal({title:'Delete', 
                                        text:'Are you sure you want to delete?', 
                                        icon:'warning', 
                                        buttons: true, 
                                        dangerMode: true
                                    })
                                .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                    $('#form'+$(this).data('value')).submit();
                } else {
                    swal("Your file is safe!");
                }
                });

                            });
                        });
                        $(document).ready( function () {
                    $('#example').DataTable();
                } );
                    </script>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>   
    </table>
    
  
    {!! $products->links() !!}
      
@endsection