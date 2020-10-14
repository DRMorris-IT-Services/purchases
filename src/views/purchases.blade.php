
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchases'
])

@section('content')

    <div class="content">
    @include('layouts.alerts')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" href="{{route('purchases')}}" role="tab" aria-controls="home" aria-selected="true">List</a>
  </li>
  @if (AUTH::user()->purchases_add == "on")
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" href="{{route('purchases.new')}}" role="tab" aria-controls="profile" aria-selected="false">New Purchase Invoice</a>
  </li>
  @endif
</ul>
    
        <div class="row">
       
            <div class="col-md-12 text-white">
                
                        <h2>Purchases</h2>
            
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Ref No.</th>
                                        <th>Purhcase Date</th>
                                        <th>Due Date</th>
                                        <th>Net</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($purchases as $i)
                                    <tr>
                                        <td>@foreach($supplier as $c) @if($i->supplier_id == $c->supplier_id) {{$c->company}} @endif @endforeach</td>
                                        <td>{{$i->invoice_ref}}</td>
                                        <td>{{date('d/m/y', strtotime($i->invoice_date))}}</td>
                                        <td>{{date('d/m/y', strtotime($i->invoice_due))}}</td>
                                        <td>{{number_format($i->net_total,2,',','.')}}</td>
                                        <td>{{number_format($i->tax_total,2,',','.')}}</td>
                                        <td>{{number_format($i->grand_total,2,',','.')}}</td>
                                        <td>{{$i->status}}</td>
                                        <td>
                                       <a href="{{route('purchases.download',['id' => $i->invoice_id])}}"> <button class="btn btn-sm btn-outline-primary fa fa-download"></button></a>
                                        <a href="{{route('purchases.view',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-success fa fa-eye"></button></a>
                                        @if(AUTH::user()->purchases_edit == "on")
                                        <a href="{{route('purchases.edit',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-warning fa fa-edit"></button></a>
                                        @endif
                                        @if(AUTH::user()->purchases_del == "on")
                                        <button class="btn btn-sm btn-outline-danger"data-toggle="modal" data-target="#invoice_del{{$i->id}}"><i class="fa fa-trash"></i></button>

                                        <!-- MODAL DELETE INVOICE -->
                                        <form class="col-md-12" action="{{ route('purchases.del',['id' => $i->invoice_id]) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                
                                                <div class="modal fade" id="invoice_del{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-dark text-white">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">REMOVE Purchase Invoice??</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                    
                                                    <h3><i class="fa fa-warning" ></i> WARNING!!</h3>
                                                    <h5>You are going to remove this purchase invoice, are you sure?</h5>
                                                    <h5>This action can <b><u>NOT BE UNDONE!</u></b></h5>
                                                        
                                                    </div>
                                                    <div class="modal-footer bg-dark text-white">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                </form>

                                                <!-- END MODAL FOR DELETE CLIENT --> 
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        
                    
            </div>
        </div>
</div>


@endsection