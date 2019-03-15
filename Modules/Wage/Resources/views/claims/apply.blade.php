@extends('backend.master')
@section('page-title')
Claim Form
@endsection
@section('page-css')
<style>
    .preloader{
        display: none !important;
    }
    form.editableform > .form-group{
        margin:10px !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Claim Subject: {!! $claim->subject ?? 'N/A' !!}</h3>
        <div class="card-options">
            <form action="{{route('claim.submit')}}" method="POST" class="submit-claim">
                @csrf
                <input type="hidden" name="claim_id" value="{{$claim->id}}">
                <button type="submit" class="btn btn-primary btn-sm">Submit This Claim</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{route('claimdetail.store')}}" method="POST" enctype="multipart/form-data" class="">
                    @csrf
                    <!-- identity -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-options">
                                <h3 class="card-title">
                                    Claim Form
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    <input type="hidden" name="claim_id" value="{{$claim->id ?? 0}}">
                                    <div class="form-group">
                                        <label for="" class="require">Claim Type</label>
                                        <select name="claimtype_id" id="" class="form-control">
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('backend.shared._errors',['entity'=>'claimtype_id'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="require">Date</label>
                                        <input type="text" name="date" id="" class="form-control date" data-provide="datepicker">
                                        @include('backend.shared._errors',['entity'=>'date'])
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="require">Amount (MYR)</label>
                                        <input type="text" name="amount" id="" class="form-control">
                                        @include('backend.shared._errors',['entity'=>'amount'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Remarks</label>
                                        <textarea name="remarks" id="" cols="30" rows="6" class="form-control"></textarea>
                                        @include('backend.shared._errors',['entity'=>'remarks'])
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Attachments</label>
                                        <button type="button" class="btn btn-block btn-md btn-primary" onclick="document.getElementById('fileInput').click();"><i
                                                class="ti ti-files"></i> Attach your file(s) here</button>
                                        <input id="fileInput" type="file" style="display:none;" name="attachments[]"
                                            multiple />
                                        @include('backend.shared._errors',['entity'=>'attachments'])
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary pull-right submit-btn" type="submit">
                                    Create
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Claim Records
                        </h3><br>
                        <p>Click on the columns to edit the values.</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Amount (MYR)</td>
                                    <td>Date</td>
                                    <td>Remarks</td>
                                </tr>
                            </thead>
                            <tbody id="claim_data">
                            </tbody>
                            <tr>
                                <td colspan="3">Total:</td>
                                <td id="claim_total"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- public holiday modal -->
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('asset-partials.datepicker')
@include('components.form.confirmDeleteOnSubmission',['entity' => 'submit-claim'])
<script src="{{asset('js/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript">
    $('.date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
<script type="text/javascript">
    function fetch_claim_data() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('api.claimdetails.index',['claimId' => $claim->id])}}",
            method: "GET",
            dataType: "json",
            success: function (data) {

                for (var count = 0; count < data.length; count++) {

                    var html_data = html_data = `<tr><td> ${count+1} </td>`;
                    html_data += '<td data-name="amount" class="amount" data-type="text" data-pk="' + data[
                        count].id + '">' + data[count].amount + '</td>';
                    html_data += '<td data-name="date" class="date" data-type="date" data-pk="' +
                        data[count].id + '">' + data[count].date + '</td>';
                    html_data +=
                        '<td data-name="remarks" class="remarks" data-type="textarea" data-pk="' + data[
                            count].id + '">' + data[count].remarks + '</td>';

                    $('#claim_data').append(html_data);
                }
            }
        })
    }
    fetch_claim_data();


    function fetch_claim_total() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('api.claim.total',['claimId' => $claim->id])}}",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $total = data.total,
                    $('#claim_total').empty().append($total)
            }
        });
    }

    fetch_claim_total();
    setInterval(fetch_claim_total, 5000);


    $.fn.editable.defaults.mode = 'inline';
    $('#claim_data').editable({
        container: 'body',
        selector: 'td.amount',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('api.claimdetails.update')}}",
        title: 'Amount',
        type: "POST",
        //dataType: 'json',
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'This field is required';
            }
        },
        success: function (data) {
            if (data.success == true) {
                return swalSuccess();
            }
        }
    });

    $('#claim_data').editable({
        container: 'body',
        selector: 'td.remarks',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('api.claimdetails.update')}}",
        title: 'Remarks',
        type: "POST",
        //dataType: 'json',
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'This field is required';
            }
        }
    });

    $('#claim_data').editable({
        container: 'body',
        selector: 'td.date',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('api.claimdetails.update')}}",
        title: 'Date',
        type: "POST",
        //dataType: 'json',
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'This field is required';
            }
        }
    });

    function swalSuccess() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            type: 'success',
            title: 'Updated successfully'
        })
    }

</script>

@endsection
