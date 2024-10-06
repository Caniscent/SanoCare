module.exports = {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
    theme: {
      extend: {},
    },
    plugins: [
      require('daisyui'),
      function ({ addUtilities }) {
        const newUtilities = {
          '.no-spinners': {
            '-moz-appearance': 'textfield',
            '-webkit-appearance': 'none',
            '&::-webkit-inner-spin-button': {
              '-webkit-appearance': 'none',
              'margin': '0',
            },
            '&::-webkit-outer-spin-button': {
              '-webkit-appearance': 'none',
              'margin': '0',
            },
          },
        };
        addUtilities(newUtilities, ['responsive', 'hover']);
      },
    ],
  };
