// select the favicon 👉
const faviconEl = document.querySelector('link[rel="icon"]')

// watch for changes 🕵️
const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')
mediaQuery.addEventListener('change', themeChange)

// listener 👂
function themeChange(event) {
	if (event.matches) {
		faviconEl.setAttribute('href', 'favicon-dark.png')
	} else {
		faviconEl.setAttribute('href', 'favicon-light.png')
	}
}
