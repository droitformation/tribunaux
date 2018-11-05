<html>
<head>
    <style type="text/css">
        @page { margin:10mm 10mm; background: #fff; font-family: Arial, Helvetica, sans-serif; page-break-inside: auto;font-size: 10px;}

        h1,h2,h3,h4,h5,p{
            display: block;
        }
        h1{
            font-size:14px;
            margin: 5px 0 5px 0;
            padding-bottom: 0;
        }
        h2{
            font-size:18px;
            margin: 10px 0;
            padding-bottom: 0;
        }
        h3{
            font-size:12px;
            color: #1e347b;
            margin: 8px 0;
            padding-bottom: 0;
        }
        h4{
            font-size:11px;
            margin: 5px 0;
            padding-bottom: 0;
        }
        h5{
            padding: 0;
            margin: 8px 0 0 0;
            background: #5e5e5e;
            display: block;
        }

        p{
            font-size: 10px;
            margin-bottom: 0;
        }
    </style>
</head>
<body style="position: relative;height:297mm;">
    <h2>Tribunaux civils de 1ère et 2ème instance en Suisse</h2>
    @foreach($tribunaux as $tribunal)
        <div>

            <div style="page-break-inside: avoid;">
                <h1>{!! $tribunal['canton'] !!}</h1>
                <p><cite>Tribunal Deuxième instance</cite></p>
                {!! $tribunal['deuxieme'] !!}
            </div>
            @if(!empty($tribunal['premier']))
                <div style="page-break-inside: avoid;">
                    <p><cite>Tribunal Première instance</cite></p>
                    {!! $tribunal['premier'] !!}
                </div>
            @endif

            <br/>
            @if(!$tribunal['districts']->isEmpty())
                <h3>Districts pour {!! $tribunal['canton'] !!}</h3>
                @foreach($tribunal['districts'] as $district)
                    <h4>{!! $district['nom'] !!}</h4>
                    {!! $district['tribunal'] !!}

                    @if(!$district['autorites']->isEmpty())
                        <div style="display: block; page-break-inside: auto; margin-top: 10px;margin-bottom:18px;">
                            <div style="display: block;background: #f3f3f3;  padding: 5px 0 8px 15px;">
                                <h3>Autorités pour {!! $district['nom'] !!}</h3>
                                @foreach($district['autorites'] as $autorite)
                                    <h4>{!! $autorite['nom'] !!}</h4>
                                    {!! $autorite['siege'] !!}
                                @endforeach
                            </div>
                        </div>
                    @endif

                @endforeach
            @endif
            <br/>
            @if(!$tribunal['autorites']->isEmpty())
                <div style="display: block; page-break-inside: auto; margin-top: 10px;margin-bottom: 20px;">
                    <div style="display: block;background: #f3f3f3;  padding: 5px 0 10px 15px;">
                        <h3>Autorités pour le canton</h3>
                        @foreach($tribunal['autorites'] as $autorite)
                            <h4>{!! $autorite['nom'] !!}</h4>
                            {!! $autorite['siege'] !!}
                        @endforeach
                    </div>
                </div>
            @endif


        </div>
    @endforeach
</body>
</html>