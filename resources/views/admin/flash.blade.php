@if(Session::has('message'))
<div id="flash-message" class="alert alert-success shadow"
    style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 250px;">
    {{ Session::get('message') }}
</div>
@endif

<script>
// Auto-hide top-right flash message
setTimeout(function() {
    let msg = document.getElementById('flash-message');
    if (msg) {
        msg.style.transition = 'opacity 0.5s ease';
        msg.style.opacity = '0';
        setTimeout(() => msg.remove(), 500);
    }
}, 3000);
</script>