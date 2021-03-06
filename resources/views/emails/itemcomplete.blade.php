@extends('layouts.email')
@section('content')
<p>
  Hi there {{$item->order->firstname}},
</p>
<p>
Your wemockup creation is finished and ready for download!
</p>
<p>
  <span><img alt="{{$item->sku->product->name}}" align="middle" src="{{$item->sku->product->image}}" /></span>
  <span>{{$item->sku->product->name}}</span>
</p>
<div><!--[if mso]>
  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
    <w:anchorlock/>
    <center>
  <![endif]-->
      <a href="{{ config('app.url')}}/order#!/item/{{$item->itemuid}}"
style="background-color:#178f8f;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">View Finished Mockup</a>
  <!--[if mso]>
    </center>
  </v:roundrect>
<![endif]--></div>



@endsection
