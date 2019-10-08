<div class="sites-logos-wrapper logos-">
    <div class="sites-logos">
        <?php $fac_sites = config('sites.fac_sites'); ?>
        @foreach($fac_sites as $name => $logo)
            @if('tribunauxcivils' != $name)
                <a target="_blank" href="{{ $logo['url'] }}">
                    <img src="{{ asset('sites/'.$logo['image']) }}" alt="{{ $name }}" />
                </a>
            @endif
        @endforeach
    </div>
    <p class="text-center">
        {{ date('Y') }} &copy; {!! trans('carte.site') !!} <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
    </p>
</div>