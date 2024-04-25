@php
$links = json_decode($menus, true);

@endphp
<div class="main-menu menu-colour">
                  <nav id="mobile-menu-right" >
                    <ul>
                    @foreach ($links as $link)
                  
                            @php
                                $href = getHref($link);
                            @endphp
                            @if (!array_key_exists("children",$link))
                            <li><a href="{{$href}}" target="{{$link['target']}}">{{$link["text"]}}</a></li>
                            @else
                            <li class="has-sub">
                                <a href="javascript:void(0)">{{$link["text"]}}</a>
                                <ul class="sub-menu">
                                @foreach ($link["children"] as $level2)
                                @php
                                    $l2Href = getHref($level2);
                                @endphp
                                @if(array_key_exists("children", $level2))
                                    <li>
                                        <a href="{{$l2Href}}">{{$level2["text"]}}</a>
                                        <ul class="sub-menu right-view">
                                        @foreach ($level2["children"] as $level3)
                                            @php
                                                $l3Href = getHref($level3);
                                            @endphp

                                        <li><a href="{{$l3Href}}">{{$level3["text"]}}</a></li>
                                        @endforeach
                                     
                                        </ul>
                                    </li>
                                @else
                                <li><a href="{{$l2Href}}">{{$level2["text"]}}</a></li>
                                @endif
                                @endforeach
                                
                                </ul>
                    </li>
                    @endif
                    @endforeach
                     
                 
                               </ul>
                  </nav>
                </div>