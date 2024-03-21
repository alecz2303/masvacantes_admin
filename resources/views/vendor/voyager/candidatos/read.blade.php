@extends('voyager::master')

<style>
    /* USER PROFILE PAGE */
.card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 8px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card-subtitle {
    padding:0 5px;
    font-size: 16px !important;
    line-height: 1.5;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card-text {
    padding:0 5px;
    font-size: 16px !important;
    line-height: 1.5;
    color: #ffffff;
    background-color: rgb(0, 0, 0) !important;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}
</style>

@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <i class="glyphicon glyphicon-pencil"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.edit') }}</span>
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            @if($isSoftDeleted)
                <a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
                </a>
            @else
                <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
                </a>
            @endif
        @endcan
        @can('browse', $dataTypeContent)
        {{-- @php
            $tipo = $_GET['tipo'];
        @endphp --}}
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <i class="glyphicon glyphicon-list"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.return_to_list') }}</span>
        </a>
        @endcan
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    <div class="col-lg-12 col-sm-12">
                        <div class="card hovercard">
                            <div class="card-background">
                                @php
                                    if ($dataTypeContent->profile_photo_path != '') {
                                        $img = $dataTypeContent->profile_photo_path;
                                        $url = setting('admin.url_candidatos').'/storage/'.$img;
                                    } else {
                                        $url = Voyager::image($dataTypeContent->avatar);
                                    }
                                @endphp
                                <img class="card-bkimg" alt="" src="{{ Voyager::image(setting('admin.imagen_bg_perfil')) }}">
                                <!-- http://lorempixel.com/850/280/people/9/ -->
                            </div>
                            <div class="useravatar">
                                <img alt="" src="{{ $url }}">
                            </div>

                        </div>
                        <div class="card hovercard">
                            <div class="card-background">

                            </div>
                            <div class="useravatar">

                            </div>
                            <div class="card-info">
                                @php
                                    if ($dataTypeContent->name == '') {
                                        $nom = $dataTypeContent->nombre;
                                    } else {
                                        $nom = $dataTypeContent->name;
                                    }
                                @endphp
                                <span class="card-title">{{ $nom }} {{ $dataTypeContent->apellidos }}</span>
                                <br>
                                <span class="card-subtitle">{{ $dataTypeContent->profesion }}</span>
                                <br>
                                <span class="card-subtitle">{{ $dataTypeContent->email }}</span>
                                <br>
                                <span class="card-subtitle">{{ $dataTypeContent->telefono }}</span>
                                <br>
                                <span class="card-subtitle">${{ number_format($dataTypeContent->salario,2,'.',',') }} (Netos mensuales) </span>
                                <br>
                                @php
                                    if ($dataTypeContent->genero == 0) {
                                        $genero = 'Hombre';
                                    } elseif ($dataTypeContent->genero == 1) {
                                        $genero = 'Mujer';
                                    } else{
                                        $genero = $dataTypeContent->genero;
                                    }
                                    $actual = Carbon\Carbon::now();
                                    $nacimiento = $dataTypeContent->fecha_nacimiento;
                                    $edad = \Carbon\Carbon::parse($dataTypeContent->fecha_nacimiento)->age;
                                    $situacion = \App\Models\Situacion::where('user_id',$dataTypeContent->id)->first();
                                @endphp
                                <span class="card-text">
                                    {{ strtoupper($genero) }} / {{ $edad }} AÑOS / {{ ($dataTypeContent->estado >= 1 && $dataTypeContent->estado <= 32)? strtoupper($dataTypeContent->estados->estado):strtoupper($dataTypeContent->estado) }} / {{ strtoupper($dataTypeContent->ciudad) }} / DISP. VIAJAR {{ ($dataTypeContent->viajar==1)?'SI':'NO' }}
                                    / DISP. CAMBIO RESIDENCIA {{ ($dataTypeContent->residencia==1)?'Si':'No' }}
                                </span>
                            </div>
                        </div>
                        <div class="card hovercard" style="padding-top: 5px !important">
                            <div class="card-info">
                                @if ($situacion)
                                    <br>
                                    <span class="card-title" style="padding-top: 20px !important;">
                                        {{ strtoupper($situacion->situacion) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @php
                        @endphp
                        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    <div class="hidden-xs">Experiencia Laboral</div>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                                    <div class="hidden-xs">Habilidades</div>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                    <div class="hidden-xs">Datos Académicos</div>
                                </button>
                            </div>
                        </div>

                        @php
                            $experiencias = \App\Models\Experiencia::where('user_id', $dataTypeContent->id)->get();
                            $idiomas = \App\Models\UserLanguage::where('user_id', $dataTypeContent->id)->get();
                            $conocimientos = \App\Models\Conocimiento::where('user_id', $dataTypeContent->id)->get();
                            $habilidades = \App\Models\Habilidad::where('user_id', $dataTypeContent->id)->get();
                            $estudios = \App\Models\Estudio::where('user_id', $dataTypeContent->id)->get();
                            $areas = \App\Models\Area::where('user_id', $dataTypeContent->id)->get();
                            $curriculum = \App\Models\Curriculum::where('user_id', $dataTypeContent->id)->first();
                            if ($curriculum) {
                                $server = explode('/', $curriculum->curriculum);
                                if ($server[0] == 'public') {
                                    $curr = setting('admin.url_candidatos').'/storage/curriculums/'.$server[2];
                                } else {
                                    $curr = 'https://masvacantes.com/uploads/'.$server[0];
                                }
                            } else {
                                $curr = "#";
                            }
                        @endphp
                        <div class="well">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Experiencia Laboral</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Empresa</th>
                                                        <th class="text-center">Giro de la Empresa</th>
                                                        <th class="text-center">Cargo</th>
                                                        <th class="text-center">Área</th>
                                                        <th class="text-center">Periodo</th>
                                                        <th class="text-center">Funciones y Logros del Cargo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($experiencias as $experiencia)
                                                        <tr>
                                                            <td>{{ $experiencia->empresa }}</td>
                                                            <td>{{ $experiencia->giro }}</td>
                                                            <td>{{ $experiencia->cargo }}</td>
                                                            <td>{{ $experiencia->area_empresa }}</td>
                                                            <td>{{ $experiencia->mes }} {{ $experiencia->anno_experiencia }} - {{ $experiencia->mes2 }} {{ $experiencia->anno_experiencia2 }}</td>
                                                            <td>{{ $experiencia->logro }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="tab2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Idiomas</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Idioma</th>
                                                                <th class="text-center">Nivel</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($idiomas as $idioma)
                                                            @php
                                                                switch ($idioma->level) {
                                                                    case '0':
                                                                        $idm = 'Muy Básico';
                                                                        break;
                                                                    case '1':
                                                                        $idm = 'Básico';
                                                                        break;
                                                                    case '2':
                                                                        $idm = 'Intermedio';
                                                                        break;
                                                                    case '3':
                                                                        $idm = 'Avanzado';
                                                                        break;
                                                                    case '4':
                                                                        $idm = 'Nativo';
                                                                        break;
                                                                }
                                                            @endphp
                                                                <tr>
                                                                    @if ($idioma->idiomas)
                                                                        <td>{{ $idioma->idiomas->idioma }}</td>
                                                                        <td>{{ $idm }}</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Conocimientos Informáticos</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Conocimiento</th>
                                                                <th class="text-center">Nivel</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($conocimientos as $conocimiento)
                                                                <tr>
                                                                    <td>{{ $conocimiento->conocimiento }}</td>
                                                                    <td>
                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ $conocimiento->level }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $conocimiento->level }}%;">
                                                                            {{ $conocimiento->level }}%
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Habilidades</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Habilidad</th>
                                                                <th class="text-center">Nivel</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($habilidades as $habilidad)
                                                                <tr>
                                                                    <td>{{ $habilidad->habilidad }}</td>
                                                                    <td>
                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ $habilidad->level }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $habilidad->level }}%;">
                                                                            {{ $habilidad->level }}%
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="tab3">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Datos Académicos</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Nivel de Estudio</th>
                                                                <th class="text-center">Institución</th>
                                                                <th class="text-center">Del</th>
                                                                <th class="text-center">Al</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($estudios as $estudio)
                                                                @php
                                                                    switch ($estudio->estudio) {
                                                                        case 0:
                                                                            $est = "Educación Primaria";
                                                                            break;
                                                                        case 1:
                                                                            $est = "Educación secundaria";
                                                                            break;
                                                                        case 2:
                                                                            $est = "Educación media superior -Bachillerato General";
                                                                            break;
                                                                        case 3:
                                                                            $est = "Educación media superior - Educación Profesional Tecnológica";
                                                                            break;
                                                                        case 4:
                                                                            $est = "Educación media superior - Bachillerato Tecnológico";
                                                                            break;
                                                                        case 5:
                                                                            $est = "Educación superior - Licenciatura";
                                                                            break;
                                                                        case 6:
                                                                            $est = "Educación superior - Especialidad";
                                                                            break;
                                                                        case 7:
                                                                            $est = "Educación superior - Maestría";
                                                                            break;
                                                                        case 8:
                                                                            $est = "Educación superior - Doctorado";
                                                                            break;
                                                                    }

                                                                    switch ($estudio->anno_inicio) {
                                                                        case 0:
                                                                            $ys = "2018";
                                                                            break;
                                                                        case 1:
                                                                            $ys = "2017";
                                                                            break;
                                                                        case 2:
                                                                            $ys = "2016";
                                                                            break;
                                                                        case 3:
                                                                            $ys = "2015";
                                                                            break;
                                                                        case 4:
                                                                            $ys = "2014";
                                                                            break;
                                                                        case 5:
                                                                            $ys = "2013";
                                                                            break;
                                                                        case 6:
                                                                            $ys = "2012";
                                                                            break;
                                                                        case 7:
                                                                            $ys = "2011";
                                                                            break;
                                                                        case 8:
                                                                            $ys = "2010";
                                                                            break;
                                                                        case 9:
                                                                            $ys = "2009";
                                                                            break;
                                                                        case 10:
                                                                            $ys = "2008";
                                                                            break;
                                                                        case 11:
                                                                            $ys = "2007";
                                                                            break;
                                                                        case 12:
                                                                            $ys = "2006";
                                                                            break;
                                                                        case 13:
                                                                            $ys = "2005";
                                                                            break;
                                                                        case 14:
                                                                            $ys = "2004";
                                                                            break;
                                                                        case 15:
                                                                            $ys = "2003";
                                                                            break;
                                                                        case 16:
                                                                            $ys = "2002";
                                                                            break;
                                                                        case 17:
                                                                            $ys = "2001";
                                                                            break;
                                                                        case 18:
                                                                            $ys = "2000";
                                                                            break;
                                                                        case 19:
                                                                            $ys = "1999";
                                                                            break;
                                                                        case 20:
                                                                            $ys = "1998";
                                                                            break;
                                                                        case 21:
                                                                            $ys = "1997";
                                                                            break;
                                                                        case 22:
                                                                            $ys = "1996";
                                                                            break;
                                                                        case 23:
                                                                            $ys = "1995";
                                                                            break;
                                                                        case 24:
                                                                            $ys = "1994";
                                                                            break;
                                                                        case 25:
                                                                            $ys = "1993";
                                                                            break;
                                                                        case 26:
                                                                            $ys = "1992";
                                                                            break;
                                                                        case 27:
                                                                            $ys = "1991";
                                                                            break;
                                                                        case 28:
                                                                            $ys = "1990";
                                                                            break;
                                                                        case 29:
                                                                            $ys = "1989";
                                                                            break;
                                                                        case 30:
                                                                            $ys = "1988";
                                                                            break;
                                                                        case 31:
                                                                            $ys = "1987";
                                                                            break;
                                                                        case 32:
                                                                            $ys = "1986";
                                                                            break;
                                                                        case 33:
                                                                            $ys = "1985";
                                                                            break;
                                                                        case 34:
                                                                            $ys = "1984";
                                                                            break;
                                                                        case 35:
                                                                            $ys = "1983";
                                                                            break;
                                                                        case 36:
                                                                            $ys = "1982";
                                                                            break;
                                                                        case 37:
                                                                            $ys = "1981";
                                                                            break;
                                                                        case 38:
                                                                            $ys = "1980";
                                                                            break;
                                                                        case 39:
                                                                            $ys = "2019";
                                                                            break;
                                                                        case 40:
                                                                            $ys = "2020";
                                                                            break;
                                                                        case 41:
                                                                            $ys = "2021";
                                                                            break;
                                                                        case 42:
                                                                            $ys = "2022";
                                                                            break;
                                                                        case 43:
                                                                            $ys = "2023";
                                                                            break;
                                                                        case 44:
                                                                            $ys = "2024";
                                                                            break;
                                                                    }

                                                                    switch ($estudio->anno_fin) {
                                                                        case 0:
                                                                            $ye = "2018";
                                                                            break;
                                                                        case 1:
                                                                            $ye = "2017";
                                                                            break;
                                                                        case 2:
                                                                            $ye = "2016";
                                                                            break;
                                                                        case 3:
                                                                            $ye = "2015";
                                                                            break;
                                                                        case 4:
                                                                            $ye = "2014";
                                                                            break;
                                                                        case 5:
                                                                            $ye = "2013";
                                                                            break;
                                                                        case 6:
                                                                            $ye = "2012";
                                                                            break;
                                                                        case 7:
                                                                            $ye = "2011";
                                                                            break;
                                                                        case 8:
                                                                            $ye = "2010";
                                                                            break;
                                                                        case 9:
                                                                            $ye = "2009";
                                                                            break;
                                                                        case 10:
                                                                            $ye = "2008";
                                                                            break;
                                                                        case 11:
                                                                            $ye = "2007";
                                                                            break;
                                                                        case 12:
                                                                            $ye = "2006";
                                                                            break;
                                                                        case 13:
                                                                            $ye = "2005";
                                                                            break;
                                                                        case 14:
                                                                            $ye = "2004";
                                                                            break;
                                                                        case 15:
                                                                            $ye = "2003";
                                                                            break;
                                                                        case 16:
                                                                            $ye = "2002";
                                                                            break;
                                                                        case 17:
                                                                            $ye = "2001";
                                                                            break;
                                                                        case 18:
                                                                            $ye = "2000";
                                                                            break;
                                                                        case 19:
                                                                            $ye = "1999";
                                                                            break;
                                                                        case 20:
                                                                            $ye = "1998";
                                                                            break;
                                                                        case 21:
                                                                            $ye = "1997";
                                                                            break;
                                                                        case 22:
                                                                            $ye = "1996";
                                                                            break;
                                                                        case 23:
                                                                            $ye = "1995";
                                                                            break;
                                                                        case 24:
                                                                            $ye = "1994";
                                                                            break;
                                                                        case 25:
                                                                            $ye = "1993";
                                                                            break;
                                                                        case 26:
                                                                            $ye = "1992";
                                                                            break;
                                                                        case 27:
                                                                            $ye = "1991";
                                                                            break;
                                                                        case 28:
                                                                            $ye = "1990";
                                                                            break;
                                                                        case 29:
                                                                            $ye = "1989";
                                                                            break;
                                                                        case 30:
                                                                            $ye = "1988";
                                                                            break;
                                                                        case 31:
                                                                            $ye = "1987";
                                                                            break;
                                                                        case 32:
                                                                            $ye = "1986";
                                                                            break;
                                                                        case 33:
                                                                            $ye = "1985";
                                                                            break;
                                                                        case 34:
                                                                            $ye = "1984";
                                                                            break;
                                                                        case 35:
                                                                            $ye = "1983";
                                                                            break;
                                                                        case 36:
                                                                            $ye = "1982";
                                                                            break;
                                                                        case 37:
                                                                            $ye = "1981";
                                                                            break;
                                                                        case 38:
                                                                            $ye = "1980";
                                                                            break;
                                                                        case 39:
                                                                            $ye = "2019";
                                                                            break;
                                                                        case 40:
                                                                            $ye = "2020";
                                                                            break;
                                                                        case 41:
                                                                            $ye = "2021";
                                                                            break;
                                                                        case 42:
                                                                            $ye = "2022";
                                                                            break;
                                                                        case 43:
                                                                            $ye = "2023";
                                                                            break;
                                                                        case 44:
                                                                            $ye = "2024";
                                                                            break;
                                                                    }
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $est }}</td>
                                                                    <td>{{ $estudio->institucion }}</td>
                                                                    <td>{{ $ys }}</td>
                                                                    <td>{{ $ye }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Áreas de Interes</h3>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Área de Interes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($areas as $area)
                                                                <tr>
                                                                    <td>{{ $area->area }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="panel panel-warning">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Currículum</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <a href="{{ $curr }}" target="_blank">
                                                        <h3><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Ver Currículum</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
    <script>
        $(document).ready(function() {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
                // $(".tab").addClass("active"); // instead of this do the below
                $(this).removeClass("btn-default").addClass("btn-primary");
            });
        });
    </script>
@stop
