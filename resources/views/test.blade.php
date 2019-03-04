<form name=alipayment action={{ url('test-retour') }} method=get target="_blank">
    <input name="_token" type="hidden" value={{ csrf_token() }}>
    <div id="body1" class="show" name="divcontent">
        <input type="text" name="test1" />
        <input type="text" name="test2" />
    </div>
    <button class="new-btn-login" type="submit" style="text-align:center;">submit</button>
</form>