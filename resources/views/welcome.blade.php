<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       {{-- bootstrap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

        <title>Demo 1 App</title>

    </head>
    <body class="antialiased">

        {{-- contents will go here --}}

        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">Home</a>
            </nav>
            <hr>
            <div class="main-content">

                {{-- livewire components will be rendered here --}}
                @livewire('product')

            </div>
        </div>

      <!-- ... Other meta tags and styles ... -->
      {{-- bootstrap js --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

      {{-- sweetalert2 --}}
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
          const Toast = Swal.mixin({
              toast: true,
              position: 'top-right',
              showConfirmButton: false,
              showCloseButton: true,
              timer: 6000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
          });

          window.addEventListener('alert', (event) => {

              const eventData = event.detail;
              const type = eventData[0].type;
              const message = eventData[0].message;

              Toast.fire({
                  icon: type,
                  title: message
              })
          });



          window.addEventListener('confirmDelete', (event) => {

             const eventData = event.detail;

              // console.log("the target function is: ",target);
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((result) => {

                  if (result.isConfirmed) {

                      window.Livewire.dispatch(eventData.targetEvent, {id:eventData.id});
                  }
              })


          });
      </script>


      <script>
        window.addEventListener('closeModal', (event) => {

            //the Id of the modal is passed from component
            const modalId = event.detail;

            //find modal
            const modal = document.getElementById(modalId);

            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            modal.setAttribute('style', 'display: none');
            // get modal backdrops
            const modalsBackdrops = document.getElementsByClassName('modal-backdrop');
            document.body.removeChild(modalsBackdrops[0]);

            // for nested modals (remove every modal backdrop)

            /*

             for (let i = 0; i < modalsBackdrops.length; i++) {
                 document.body.removeChild(modalsBackdrops[i]);
             }

           */

        })
    </script>

    </body>
</html>
