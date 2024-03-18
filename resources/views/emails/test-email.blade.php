    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore rem, tempora aliquam sed quidem repellat architecto enim porro repudiandae? Vel.</h1>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore, facilis?


    {{-- <img src="{{$qr}}" alt=""> --}}
    <img alt="QR Code" src="data:image/png;base64, {!!
        base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
        ->size(500)->generate($qr)) !!} ">
    
    <h2>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus consectetur placeat laudantium quaerat cum, et amet excepturi, quasi nostrum dolorum ducimus hic facilis dolore ipsa? Omnis atque placeat explicabo suscipit voluptates, iure dicta cum nisi nobis excepturi harum qui debitis nam ipsam? Est quia saepe vitae, possimus earum, optio rem omnis quas id doloremque amet iste, vel accusantium consequatur molestiae.</h2>
