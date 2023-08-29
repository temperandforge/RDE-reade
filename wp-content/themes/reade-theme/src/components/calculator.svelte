<script>
	import { onMount } from 'svelte'

	//export let fields

	// tdd
	//TODO assumes all same length
	// a tags
	//multiple open at a time; stay open?
	let activeIdx = -1
	const testData = [
		//rows of columns/values
		[1, 2, 3, 4, 5, 6, 7, 8, 9],
		[2, 3, 4, 5, 6, 7, 8, 9, 10],
		[3, 4, 5, 6, 7, 8, 9, 10, 11],
		[4, 5, 6, 7, 8, 9, 10, 11, 12],
	]

	if (!calculatorData.btn.target) {
		calculatorData.btn.target = '_self'
	}

	const content = calculatorData
	$: console.log(calculatorData) //TODO multiple?
	const groups = calculatorData.dropdown_groups

	onMount(() => {
		document.querySelectorAll('.hs-dropdown-toggle').forEach((el) =>
			el.addEventListener('click', (e) => {
				e.preventDefault()
				// console.log(e.target)
				// console.log(e.target.parentNode.querySelector('.hs-dropdown-menu'))
				// console.log(e.target.parentNode.querySelector('.hs-dropdown-menu').classList.contains('.hs-dropdown-open'))
				window.$('.hs-dropdown-menu').removeClass('hs-dropdown-open')
				console.log(
					e.target.parentNode //.querySelector('.hs-dropdown-menu').classList
				)
				e.target.parentNode
					.querySelector('.hs-dropdown-menu')
					.classList.toggle('hs-dropdown-open')
				console.log(
					e.target.parentNode
						.querySelector('.hs-dropdown-menu')
						.classList.contains('.hs-dropdown-open')
				)
			})
		)

		//close on blur
		window.addEventListener('click', function (e) {
			if (!e.target.closest('.hs-dropdown')) {
				window.$('.hs-dropdown-menu').removeClass('hs-dropdown-open')
			}
		})
	})
</script>

<section class="calculator">
	<div class="calculator--content">
		<h2>{content.heading}</h2>
		<p>{content.content}</p>
		{#if content.btn}
			<a href={content.btn} class="btn" target={content.btn.target}>
				<span>{content.btn.title}</span>
			</a>
		{/if}
	</div>
	<div class="calculator--wrap flex flex-wrap gap-x-6">
		{#each groups as group, rowidx}
			<div>
				<h3>{group.label}</h3>
				<div class="flex gap-x-6">
					{#each group['dropdowns'] as dd, colidx}
						<div>
							<h4>{dd.label}</h4>
							<div class="hs-dropdown relative inline-flex [--trigger:hover]">
								<button
									id="hs-dropdown-hover-event"
									type="button"
									class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm _dark:bg-slate-900 _dark:hover:bg-slate-800 _dark:border-gray-700 _dark:text-gray-400 _dark:hover:text-white _dark:focus:ring-offset-gray-800 border-[var(--primary-500-main, #009FC6)]"
								>
									{activeIdx > -1
										? dd.values.length > activeIdx
											? dd.values[activeIdx]['value']
											: 'N/A'
										: 'Actions'}
									<svg
										aria-hidden="true"
										class="hs-dropdown-open:rotate-180 w-2.5 h-2.5 text-gray-600"
										width="16"
										height="16"
										viewBox="0 0 16 16"
										fill="none"
										xmlns="http://www.w3.org/2000/svg"
									>
										<path
											d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
											stroke="currentColor"
											stroke-width="2"
											stroke-linecap="round"
										/>
									</svg>
								</button>

								<div
									class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50"
									aria-labelledby="hs-dropdown-hover-event"
								>
									{#each dd.values as entry, idx}
										<button
											on:click={() => (activeIdx = idx)}
											class="whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300"
											data-idx={idx}
										>
											{entry.value}
										</button>
									{/each}
								</div>
								<!-- <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50" aria-labelledby="hs-dropdown-hover-event">
            {#each ["Team Account", "Downloads"] as entry, idx}
            <a 
               class="whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300" 
               data-idx={idx} 
               href={`#${entry}`}>
               xItem { entry }
            </a>
            {/each}
         </div> -->
							</div>
						</div>
					{/each}
				</div>
			</div>
		{/each}
	</div>
</section>
