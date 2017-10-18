@extends("template")
@section("contenu")
    <section>
        <div class="container" id="failed">
            <div class="separated hidden-xs "></div>

            <div class="col-md-8 col-md-offset-2">
                <div class="bg-custom2">
                    <div class="alert alert-warning">
                        Payment failed !!.
                    </div>
                    <div class="row">
                        <!--<div class="col-md-6 col-md-offset-3 center">
                            <button type="button" class="btn btn-success btn-lg ">Confirm</button>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("script")
@endsection