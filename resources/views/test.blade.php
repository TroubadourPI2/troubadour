@extends('layouts.app')

@section('title', 'Page de Test')

@section('contenu')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-bold text-center text-c1">Page de Test Blade</h1>
    <iframe width="500" height="500" frameborder="0" scrolling="no" allowfullscreen src="https://geo.v3r.net/portal/apps/webappviewer/index.html?id=ba4ee49d7b21405189197c270419dbab&extent=-8081095.0388%2C5832525.0786%2C-8066419.1293%2C5838859.7973%2C102100"></iframe>



    </div>
@endsection

@section('footer')
@endsection
<script>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "YOUR_API_KEY",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
</script>
<script src="{{ asset('js/test.js') }}"></script>