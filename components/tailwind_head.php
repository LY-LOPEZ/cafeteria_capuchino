<script>
   window.tailwind = window.tailwind || {};
   window.tailwind.config = {
      prefix: 'tw-',
      corePlugins: {
         preflight: false
      },
      theme: {
         extend: {
            colors: {
               coffee: {
                  50: '#fff8ed',
                  100: '#f8ead2',
                  300: '#d8a863',
                  500: '#9a6a3a',
                  700: '#5c341f',
                  900: '#20130b'
               },
               sage: '#7f8d72'
            },
            fontFamily: {
               display: ['Playfair Display', 'serif'],
               sans: ['Outfit', 'sans-serif']
            },
            boxShadow: {
               cafe: '0 24px 70px rgba(55, 38, 24, .16)'
            }
         }
      }
   };
</script>
<script src="https://cdn.tailwindcss.com"></script>
