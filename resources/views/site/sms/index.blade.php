<form action="{{ route('sms.send') }}" method="POST">
    @csrf
    <div class="form-group">
        <input type="text" name="mobile" class="form-control">
        <input type="text" name="message" class="form-control">
        <button class="btn btn-primary" type="submit">send</button>
    </div>

</form>
