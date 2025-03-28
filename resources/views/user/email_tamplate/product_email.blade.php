@php
    $setting = DB::table('web_sites')->first();
@endphp
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e8ebef">
    <tr>
        <td align="center" valign="top" class="container" style="padding:50px 10px;">
            <!-- Container -->



            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                            <tr>
                                <td class="td" bgcolor="#ffffff"
                                    style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                    <!-- Header -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                        bgcolor="#ffffff">
                                        <tr>
                                            <td class="p30-15-0" style="padding: 40px 30px 0px 30px;">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <th class="column"
                                                            style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                            <table width="100%" border="0" cellspacing="0"
                                                                cellpadding="0">
                                                                <tr>
                                                                    <td class="img m-center"
                                                                        style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                        <img src="{{ asset('backend/setting/' . $setting->image) }}"
                                                                            width="100" height="44" border="0"
                                                                            alt="" /></td>
                                                                </tr>
                                                            </table>
                                                        </th>
                                                        <th class="column-empty" width="1"
                                                            style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                        </th>
                                                        <th class="column" width="120"
                                                            style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                            <table width="100%" border="0" cellspacing="0"
                                                                cellpadding="0">
                                                                <tr>
                                                                    {{-- <td class="text-header right" style="color:#000000; font-family:'Fira Mono', Arial,sans-serif; font-size:12px; line-height:16px; text-align:right;"><a href="{{ env('APP_URL') }}" target="_blank" class="link" style="color:#000001; text-decoration:none;"><span class="link" style="color:#000001; text-decoration:none;">{{ env('APP_NAME') }}</span></a></td> --}}
                                                                </tr>
                                                            </table>
                                                        </th>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="separator"
                                                            style="padding-top: 40px; border-bottom:4px solid #000000; font-size:0pt; line-height:0pt;">
                                                            &nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- END Header -->
                                    <!-- Intro -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                        bgcolor="#ffffff">
                                        <tr>
                                            <td class="p30-15" style="padding: 30px 30px 70px 30px;">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td
                                                            style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:14px; line-height:20px; padding-bottom:10px;">
                                                            <p><span
                                                                    style="font-weight: bold; text-decoration: underline;">Here
                                                                    is your product links</span></p>
                                                            @foreach ($emailContent['product_url'] as $key => $link)
                                                                @if ($emailContent['product_name'])
                                                                    <p><b>Name:
                                                                            {{ $emailContent['product_name'][$key] }}</b>
                                                                    </p>
                                                                @endif

                                                                @if (filter_var($link, FILTER_VALIDATE_URL))
                                                                    <p><a target="_blank" href="{{ $link }}">
                                                                            {{ substr($link, 0, 100) }}....</a></p>
                                                                @else
                                                                    <p><a target="_blank" href="{{ $link }}">
                                                                            {{ $link }}....</a></p>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <style>
                                                        p a {
                                                            text-decoration: none;
                                                            color: darkred;
                                                        }

                                                        p a:hover {
                                                            text-decoration: underline;
                                                            color: #000000;
                                                        }
                                                    </style>

                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- END Intro -->
                                </td>
                            </tr>
                            <tr>
                                <td class="text-footer"
                                    style="padding-top: 30px; color:#1f2125; font-family:'Fira Mono', Arial,sans-serif; font-size:12px; line-height:22px; text-align:center;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- END Container -->
        </td>
    </tr>
</table>
