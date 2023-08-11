<script>
	import { onMount } from "svelte"

	export let fields

	if (!fields.btn.target) {
		fields.btn.target = '_self'
	}
	console.log(fields)

   onMount(() => {
      document.querySelectorAll('.hs-dropdown-toggle').forEach(el => el.addEventListener('click', (e) => {
         e.preventDefault()
         console.log(e.target)
         // console.log(e.target.parentNode.querySelector('.hs-dropdown-menu'))
         // console.log(e.target.parentNode.querySelector('.hs-dropdown-menu').classList.contains('.hs-dropdown-open'))
         e.target.parentNode.querySelector('.hs-dropdown-menu').classList.toggle('hs-dropdown-open')
         console.log(e.target.parentNode.querySelector('.hs-dropdown-menu').classList.contains('.hs-dropdown-open'))
      }))
   })
</script>

<section class="calculator">
   <div class="calculator--content">
      <h2>{fields.heading}</h2>
      <p>{fields.content}</p>
      {#if fields.btn}
         <a href={fields.btn} class="btn" target={fields.btn.target}>
            <span>{fields.btn.title}</span>
         </a>
      {/if}
   </div>
   <div class="calculator--wrap mt-8 flex gap-x-6">
      <div class="hs-dropdown relative inline-flex [--trigger:hover]">
         <button id="hs-dropdown-hover-event" type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm _dark:bg-slate-900 _dark:hover:bg-slate-800 _dark:border-gray-700 _dark:text-gray-400 _dark:hover:text-white _dark:focus:ring-offset-gray-800 border-[var(--primary-500-main, #009FC6)]">
           Actions
           <svg class="hs-dropdown-open:rotate-180 w-2.5 h-2.5 text-gray-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
           </svg>
         </button>
       
         <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50" aria-labelledby="hs-dropdown-hover-event">
            {#each ["Team Account", "Downloads"] as entry, idx}
            <a 
               class="whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300" 
               data-idx={idx} 
               href={`#${entry}`}>
               { entry }
            </a>
            {/each}
         </div>
         <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50" aria-labelledby="hs-dropdown-hover-event">
            {#each ["Team Account", "Downloads"] as entry, idx}
            <a 
               class="whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300" 
               data-idx={idx} 
               href={`#${entry}`}>
               { entry }
            </a>
            {/each}
         </div>
      </div>
      <div class="hs-dropdown relative inline-flex [--trigger:hover]">
         <button id="hs-dropdown-hover-event" type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm _dark:bg-slate-900 _dark:hover:bg-slate-800 _dark:border-gray-700 _dark:text-gray-400 _dark:hover:text-white _dark:focus:ring-offset-gray-800 border-[var(--primary-500-main, #009FC6)]">
           Actions
           <svg class="hs-dropdown-open:rotate-180 w-2.5 h-2.5 text-gray-600" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
           </svg>
         </button>
       
         <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50" aria-labelledby="hs-dropdown-hover-event">
            {#each ["Team Account", "Downloads"] as entry, idx}
            <a 
               class="whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300" 
               data-idx={idx} 
               href={`#${entry}`}>
               { entry }
            </a>
            {/each}
         </div>
         <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50" aria-labelledby="hs-dropdown-hover-event">
            {#each ["Team Account", "Downloads"] as entry, idx}
            <a 
               class="whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300" 
               data-idx={idx} 
               href={`#${entry}`}>
               { entry }
            </a>
            {/each}
         </div>
      </div>
   </div>
</section>
