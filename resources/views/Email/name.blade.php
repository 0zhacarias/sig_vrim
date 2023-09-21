@component('mail::message')
    Cordiais saudações senhor :{{ $nome_marca_visita }}
    <p>Tens uma visita marcada para o dia X nas Horas X{{ $mensagem }} </p>
    <p>Por favor confirme a nesse mesmo E-mail</p>

    Clique no Botão a baixo para ser rediricionado ao site Kubicos:
    @component('mail::button', ['url' => $url, 'color' => 'success'])
        Verificar
    @endcomponent
    Atenciosamente ,<br>
   Kubicos({{ config('app.name') }})
@endcomponent