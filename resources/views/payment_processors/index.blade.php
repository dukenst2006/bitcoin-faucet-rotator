@extends('app')

@section('title', 'List of Payment Processors ('. count($paymentProcessors) . ') | FreeBTC.website')

@section('description', "This page lists all bitcoin faucets' payment processors currently on the system, with sortable columns. There are " . count($paymentProcessors) . " processors listed.")

@section('keywords', 'Free Bitcoins, Bitcoin Faucets, Xapo, MicroWallet, BlockChain, Paytoshi, FaucetBox')

@section('content')
    <h1 class="page-heading">Current Payment Processors</h1>

    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
    <p id="comments"><small><a href="#disqus_thread">See comments</a></small></p>
    @endif

    @if (Session::has('success_message_delete'))
        <div class="alert alert-success">
            <span class="fa fa-thumbs-o-up fa-2x space-right"></span>
            {{ Session::get('success_message_delete') }}
        </div>
    @endif

    @if (Session::has('success_message_alert'))
        <div class="alert alert-info">-
            <span class="fa fa-warning fa-2x space-right"></span>
            {{ Session::get('success_message_alert') }}
        </div>
    @endif
    @include('partials.ads')
    @if(Auth::check())
        <div class="alert alert-info">
            <p><i class="fa fa-info-circle fa-2x space-right"></i>Tags are created when creating and editing payment processors.</p>
        </div>
    @endif
    <div class="table-responsive">

        <table class="table table-striped bordered tablesorter" id="payment_processors_table">
            <thead>
            <th>Payment Processor Name</th>
            <th>Tags</th>
            <th>Associated Faucet Rotator</th>
            </thead>
            <tbody>
            @foreach($paymentProcessors as $paymentProcessor)
                <tr>
                    <td>{!! link_to_route('payment_processors.show', $paymentProcessor->name, array($paymentProcessor->slug), ['title' => $paymentProcessor->name]) !!}</td>
                    <td>
                        @if(count($paymentProcessor->keywords()->get()) > 0)
                            <ul>
                                @foreach($paymentProcessor->keywords()->orderBy('keyword')->get() as $tag)
                                    <li>
                                        {!! link_to_route('tags.show', $tag->keyword, ['slug' => $tag->slug]) !!}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>There are no tags for this payment processor.</li>
                            </ul>
                        @endif
                    </td>
                    <td>
                        @if(count($paymentProcessor->faucets()->get()) > 0)
                            <a class="btn btn-primary btn-lg" href="{!! URL::to('/payment_processors/' . $paymentProcessor->slug . '/rotator/') !!}" title="Surf {{ $paymentProcessor->name }} Faucets" role="button">Surf {{ $paymentProcessor->name }} Faucets</a>
                        @else
                            There are no faucets that use this payment processor.
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName())
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            var disqus_shortname = '{{ \App\Helpers\WebsiteMeta\WebsiteMeta::disqusShortName() }}';
            var disqus_identifier = 'list-of-payment-processors';

            (function() {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] ||
                document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>
            Please enable JavaScript to view the
            <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
        </noscript>
        <a href="http://disqus.com" class="dsq-brlink">
            comments powered by <span class="logo-disqus">Disqus</span>
        </a>
    @endif
    <br><br>
@endsection

@section('coinurl_linkshortening')
    @include('partials.coinurl_linkshortening')

@section('google_analytics')
    @include('partials.google_analytics')
@stop