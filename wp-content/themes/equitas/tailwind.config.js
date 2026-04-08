/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
  "./*.php",
  "./template-parts/**/*.php",
  "./templates/**/*.php",
  "./assets/js/**/*.js"
],
  safelist: [
    'bg-primary',
    'text-primary',
    'rounded-xl',
    "flex",
    "flex-col",
    "flex-grow",
    "min-h-screen",
    "mt-auto",
    "grid",
    "grid-rows-[1fr_auto]",
    'grid-cols-12'
    'col-span-12'
    'lg:col-span-8'
    'gap-8'
    "pt-20"
    'border-primary',
    'border-secondary',
    'border-tertiary-container',
    'text-primary',
    'text-secondary',
    'text-tertiary-container'
    'h-screen'
  ],
  theme: {
    extend: {
      colors: {
                "primary-fixed": "#d3e3ff",
                "primary": "#000c1e",
                "inverse-primary": "#adc8f2",
                "surface-container-high": "#e7e8e9",
                "error": "#ba1a1a",
                "on-secondary-fixed-variant": "#00522f",
                "on-primary": "#ffffff",
                "tertiary-fixed-dim": "#e9c176",
                "on-tertiary": "#ffffff",
                "tertiary": "#130b00",
                "on-secondary-fixed": "#002110",
                "on-primary-fixed-variant": "#2c486b",
                "inverse-surface": "#2e3132",
                "tertiary-container": "#2f2000",
                "secondary-container": "#9af2ba",
                "on-tertiary-fixed-variant": "#5d4201",
                "error-container": "#ffdad6",
                "surface-container-lowest": "#ffffff",
                "surface-container-highest": "#e1e3e4",
                "on-secondary": "#ffffff",
                "surface-variant": "#e1e3e4",
                "on-background": "#191c1d",
                "inverse-on-surface": "#f0f1f2",
                "on-surface": "#191c1d",
                "on-tertiary-container": "#a78541",
                "on-primary-container": "#708bb2",
                "on-error-container": "#93000a",
                "outline-variant": "#c3c6cf",
                "secondary-fixed-dim": "#81d9a2",
                "secondary-fixed": "#9df5bd",
                "primary-container": "#002344",
                "surface-dim": "#d9dadb",
                "outline": "#74777f",
                "on-tertiary-fixed": "#261900",
                "on-secondary-container": "#0e7144",
                "on-error": "#ffffff",
                "primary-fixed-dim": "#adc8f2",
                "surface-container": "#edeeef",
                "on-primary-fixed": "#001c38",
                "background": "#f8f9fa",
                "surface": "#f8f9fa",
                "surface-container-low": "#f3f4f5",
                "surface-bright": "#f8f9fa",
                "on-surface-variant": "#43474e",
                "tertiary-fixed": "#ffdea5",
                "surface-tint": "#456084",
                "secondary": "#046d40"
              },
      fontFamily: {
                "headline": ["Manrope"],
                "body": ["Inter"],
                "label": ["Inter"]
              },
              borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
    }
  },
  plugins: []
};