<form name=alipayment action={{ url('test-retour') }} method=get target="_blank">
    <input name="_token" type="hidden" value={{ csrf_token() }}>
    <div id="body1" class="show" name="divcontent">
        <!--<input type="text" name="test1" />
        <input type="text" name="test2" />-->
        <input type="hidden" id="WIDout_trade_no" name="WIDout_trade_no" >
        <input type="hidden" id="WIDsubject" name="WIDsubject" value="uv123">
        <input type="hidden" id="WIDtotal_amount" name="WIDtotal_amount" value="0.01">
        <input type="hidden" id="WIDbody" name="WIDbody" value="testdsfsd">
    </div>
    <button class="new-btn-login" type="submit" style="text-align:center;">submit</button>
</form>