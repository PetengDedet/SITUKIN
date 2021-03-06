@if ($errors->any())
@foreach ($errors->all() as $error)
<script type="text/javascript">
$.notify({
// options
  message: '{{ $error }}' 
},{
  // settings
  placement: {
            from: "bottom",
            align: "left"
        },
  type: 'danger'
});
</script>
@endforeach
@endif

@if ($message = Session::get('success'))
<script type="text/javascript">
$.notify({
// options
  message: '{{$message}}' 
},{
  // settings
  placement: {
            from: "bottom",
            align: "left"
        },
  type: 'success'
});
</script>
@endif
@if ($message = Session::get('error'))
<script type="text/javascript">
$.notify({
// options
  message: '{{$message}}' 
},{
  // settings
  placement: {
            from: "bottom",
            align: "left"
        },
  type: 'danger'
});
</script>
@endif

@if ($message = Session::get('warning'))
<script type="text/javascript">
$.notify({
// options
  message: '{{$message}}' 
},{
  // settings
  placement: {
            from: "bottom",
            align: "left"
        },
  type: 'danger'
});
</script>
@endif

@if ($message = Session::get('info'))
<script type="text/javascript">
$.notify({
// options
  message: '{{$message}}' 
},{
  // settings
  placement: {
            from: "bottom",
            align: "left"
        },
  type: 'danger'
});
</script>
@endif
