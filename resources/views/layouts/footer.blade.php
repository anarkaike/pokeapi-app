<footer class="bg-[#0E9AEF] shadow mt-5 bg-contain bg-no-repeat bg-bottom"
    style="background-image: url('{{ asset('images/footer.png') }}');">
    <div
        class="py-1 text-center text-white flex flex-col md:flex-row items-center justify-evenly space-y-2 md:space-y-0 md:space-x-4">
        <a href="https://ipe.digital/" target="_blank">
            <span class="w-[120px] h-[45px] inline-block align-middle bg-cover bg-left-bottom bg-no-repeat""
                style="background-image: url('{{ asset('images/logo-ipe-digital-rodape.png') }}');"></span>
        </a>


        <span class="text-sm inline-block">
            &copy; {{ date('Y') }} {{ config('app.name', 'PokéApp') }}. Todos os direitos reservados.
        </span>

        <span class="flex space-x-2">
            <a href="https://www.facebook.com/ipe.digital.softwares" target="_blank">
                <img src="{{ asset('images/icon-facebook.png') }}" alt="Facebook" class="w-7" />
            </a>
            <a href="https://www.instagram.com/ipe.digital/" target="_blank">
                <img src="{{ asset('images/icon-instagram.png') }}" alt="Instagram" class="w-7" />
            </a>
            <a href="mailto:contato@ipe.digital" target="_blank">
                <img src="{{ asset('images/icon-email.png') }}" alt="Email" class="w-7" />
            </a>
        </span>
    </div>
</footer>
