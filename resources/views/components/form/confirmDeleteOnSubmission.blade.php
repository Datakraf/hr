@include('asset-partials.sweetalert')
<script type="text/javascript">
    $(".{!!$entity!!}").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            confirmButtonText: '<i class="ti ti-check"></i> Yes, I\'m sure',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: '<i class="ti ti-close"></i> Nope, abort mission',
            cancelButtonAriaLabel: 'Thumbs down',
            reverseButtons:true
        }).then((result) => {
            if (result.value) {
                $(".{!!$entity!!}").trigger('submit');
            }
        });
    });

</script>
