@extends('layout')

<style>
    .demo-area{
    background:$color_invert_fg;
    border-radius:8px;
    padding:20px;
    section{
        padding-top:0;
    }
    }

    .demo-trigger {
    display: inline-block;
    width: 30%;
    float: left;
    }

    .detail {
    position: relative;
    width: 65%;
    margin-left: 5%;
    float: left;
    button{
        vertical-align:middle;
        opacity:.5;
        cursor:unset;
        background:$color_invert_chrome_tint;
        margin-left:1em;
    }
    }


    @media (max-width: 610px) {

    .detail, .demo-trigger {
        float: none;
    }

    .demo-trigger {
        display:block;
        width: 50%;
        max-width:200px;
        margin: 0 auto;
    }

    .detail {
        margin: 0;
        width: auto;
    }

    p {
        margin: 0 auto 1em;
    }

    .responsive-hint {
        display: none;
    }
    h3 {
        margin-top:20px;
    }
    }
</style>
@section('content')
    <section class="content">
        <article class="demo-area">
        <img class="demo-trigger" src="https://demos.imgix.net/wristwatch.jpg?w=200&ch=DPR&dpr=2&border=1,ddd" data-zoom="https://demos.imgix.net/wristwatch.jpg?w=1000&ch=DPR&dpr=2">
        <div class="detail">
            <section>
                <h3>Men's Watch - Drift Demo</h3>
                <p>Specifications:</p>
                <ul>
                    <li>Hover over image</li>
                    <li>35 mm stainless steel case</li>
                    <li>Stainless link bracelet with buckle closure</li>
                    <li>Water resistant to 100m</li>
                </ul>
                <h4>$XX.XX <button>Add to Cart</button></h4>
            </section>
        </div>
        </article>
    </section>
@endsection

@section('extra-js')
<script>
    var demoTrigger = document.querySelector('.demo-trigger');
    var paneContainer = document.querySelector('.detail');

    new Drift(demoTrigger, {
    paneContainer: paneContainer,
    inlinePane: false,
    });
</script>

@endsection