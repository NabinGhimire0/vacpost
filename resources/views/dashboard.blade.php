<x-app-layout>
    <x-slot name="title">
        home
    </x-slot>


    @foreach ($posts as $post)
        <x-post :post="$post">
            <x-slot name="script">
                <script>
                    function changeMainImage(element, mainImageId) {
                        const mainImage = document.getElementById(mainImageId);
                        mainImage.src = element.src;
                    }

                    function toggleLike(button) {
                        button.classList.toggle('liked');
                        // You can add an AJAX request here to update the like status in the database
                    }
                </script>
            </x-slot>
        </x-post>
    @endforeach
    
</x-app-layout>
