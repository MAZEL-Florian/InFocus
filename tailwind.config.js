import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        colors: {
            'infocus-bluenight': "#03091d",
            'infocus-twilightblue': "#00132E",
            'infocus-anthracitegrey': "#1E1E1E",
            'infocus-earthybrown': "#250F03",
            'infocus-redphoto': "#DF121A",
            'infocus-intenseblue': "#2D5EA1",
            'infocus-oceanblue': "#041560",
            'infocus-icewhite': "#F6FDFF",
        },
        extend: {
            fontFamily: {
                quicksand: ['Quicksand', 'sans-serif'],
                abeezee: ['ABeeZee', 'sans-serif'],
                ruthie: ['Ruthie', 'sans-serif']
              },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}


