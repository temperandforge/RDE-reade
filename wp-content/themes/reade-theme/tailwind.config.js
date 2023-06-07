/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [ '**/*.php', './src/**/*.{html,js,scss,svelte}' ],
	corePlugins: { //for disabling
	},
	theme: {
		// border: {
		// 	1: "2px solid #009FC6",
		// },
		// fontFamily: {},
		extend: {
			borderRadius: {
				1: "5px"
			},
			colors: {
				// Primary
				'primary50':      '#EFFBFF',
				'primary100':     '#CFEEF7',
				'primary200':     '#BAE3E9',
				'primary300':     '#8BD4DF',
				'primary400':     '#61C5DD',
				'primary500':     '#009FC6',
				'primary600':     '#0794B7',
				'primary700':     '#007B99',
				'primary800':     '#006078',
				'primary900':     '#004455',
				'footer-primary': '#072D36',

				'blue50':      '#EFFBFF',
				'blue100':     '#CFEEF7',
				'blue200':     '#BAE3E9',
				'blue300':     '#8BD4DF',
				'blue400':     '#61C5DD',
				'blue500':     '#009FC6',
				'blue600':     '#0794B7',
				'blue700':     '#007B99',
				'blue800':     '#006078',
				'blue900':     '#004455',
				'footer-blue': '#072D36',
				

				// Secondary
				'light-beige': '#E2D7D7',
				'medium-beige':'#CBBBBB',
				'dark-beige':  '#BCA39C',
				'heavy-beige': '#9E7E75',
				'ultra-beige': '#786059',
				'green': 		'#8BC53F',
				'superlight':  '#F3EFEF',
			},
			screens: {
				ml: '992px',
				'2xl': '1440px',
				'3xl': '1536px',
				'4xl': '1750px',
				'5xl': '1920px',
				'6xl': '2150px',
				'7xl': '2400px',
			},
		},
	},
	// @SEE https://tailwindcss.com/docs/plugins
	//plugins: [require("rippleui")],
	// plugins: {
	// 	tailwindcss: {},
	// 	autoprefixer: {},
	// },
};
