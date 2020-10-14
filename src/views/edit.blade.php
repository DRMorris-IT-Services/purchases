@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'purchases'
])

@section('content')
@foreach ($purchases as $inv)

    <div class="content">
    @include('purchases::layouts.alerts')
    
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
                
                        <h2>Update Purchase Invoice - Ref {{ $inv->invoice_ref}}</h2>
                    
            </div>
        </div>
        <form  action="{{ route('purchases.update',['id' => $inv->invoice_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')  

        <div class="row">

        
        <div class="col-md-4 text-white">
                
                        <h5 class="card-title">Supplier</h5>
                        
                    
                        
                       <select class="form-control bg-dark text-white" name="supplier" onchange="submit()">
                       @foreach ($supplier as $c)<option value="{{$c->supplier_id}}">{{ $c->company }}</option>@endforeach
                       <option></option>
                       @foreach ($suppliers as $cl)
                        <option value="{{$cl->supplier_id}}">{{$cl->company}}</option>
                       @endforeach
                        </select>

                        <br><br>
                        <h6>Purchase Reference: <input type="text" class="form-control bg-dark text-white" name="ref_no" value="{{$inv->invoice_ref}}" onchange="submit()"></h6>
                            
                    
            </div>

        <div class="col-md-4 text-white">
               
                        <h5>Dates</h5>
                        
                    
                        <h6>Purchase Date: <input type="text" class="form-control bg-dark text-white" name="quote_date" value="{{$inv->invoice_date}}" onchange="submit()"></h6>
                        <h6>Purchase Due: <input type="text" class="form-control bg-dark text-white" name="due_date" value="{{$inv->invoice_due}}" onchange="submit()"></h6>
                        <h6>Created On: {{ $inv->created_at }}</h6>
                        <h6>Updated On: {{ $inv->updated_at }}</h6>
                    
            </div>

            <div class="col-md-4 text-white">
                
                        <h5>Status</h5>
                    
                        <select class="form-control bg-dark text-white" name="status" onchange="submit()">
                        <option>{{ $inv->status}}</option>
                        <option>--------</option>
                        <option>Confirmed</option>
                        <option>Awaiting Delivery</option>
                        <option>Delivered</option>
                        <option>Closed</option>
                        </select>
                        
                        
                   
            </div>
</form>

        </div>

        <br><br>

        <div class="row">
        <div class="col-md-12 text-white">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
       
        @if (AUTH::user()->purchases_edit == "on")
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" href="{{route('purchases.ln.new',['id' => $inv->invoice_id])}}" role="tab" aria-controls="profile" aria-selected="false">New Line Item</a>
        </li>
        @endif
        </ul>

               
                        <h5>Quotation Items</h5>
                       

                        <table class="table">
                            <thead>
                        <tr>
                        <th>Qty</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Net Total</th>
                        <th>Tax </th>
                        <th>Tax Exempt</th>
                        <th>Gross Total</th>
                        </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchase_lines as $ln)
                            <form class="col-md-12" action="{{ route('purchases.ln.update',['id' => $ln->id, 'iid' => $inv->invoice_id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')  
                            <tr>
                            <td width="100px"><input type="text" id="qty" class="form-control col-12 bg-dark text-white" name="qty" value="{{$ln->qty}}" onchange="submit()"></td>
                            <td><input type="text" class="form-control col-12 bg-dark text-white" name="description" value="{{$ln->description}}" onchange="submit()"></td>
                            <td width="150px"><input type="text" id="price" class="form-control col-12 bg-dark text-white" name="price" value="{{$ln->line_price}}" onchange="submit()" ></td>
                            <td width="150px"><input type="text" id="net" class="form-control col-12 bg-dark text-white" name="net" value="{{$ln->line_net}}" onchange="submit()"></td>
                            <td width="150px"><input type="text" id="tax" class="form-control col-12 bg-dark text-white" name="tax" value="{{$ln->line_tax}}" onchange="submit()"></td>
                            <td width="80px">@if($ln->line_tax_exempt == "on")<input type="checkbox" class="form-control" name="no-tax" onchange="submit()" checked>@else <input type="checkbox" class="form-control" name="no-tax" onchange="submit()">@endif</td>
                            <td width="150px"><input type="text" id="totalPrice" class="form-control col-12 bg-dark text-white" name="total" value="{{$ln->line_total}}" onchange="submit()"></td>
                            </tr>
                            </form>
                            @endforeach
                            </tbody>
                        </table>
                        
                        
                   
            </div>

        </div>

        <br><br>
        <div class="row justify-content-end">
            <div class="col-md-3 text-white">
                
                        <h5 >Totals</h5>
                 

                        <h6>Total Net: {{ number_format($inv->net_total,2,',','.')}}&euro;</h6>
                        <h6>Total Tax: {{ number_format($inv->tax_total,2,',','.')}}&euro;</h6>
                        <h6>Grand Total: {{ number_format($inv->grand_total,2,',','.')}}&euro;</h6>
                        
                    
            </div>
        </div>

</div>

@endforeach
@endsection

