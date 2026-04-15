<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EcoDon | Blog Editor</title>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "tertiary-container": "#434545",
                    "on-secondary-fixed": "#002113",
                    "surface-container-low": "#fcf2eb",
                    "inverse-on-surface": "#f9efe8",
                    "surface-bright": "#fff8f5",
                    "on-background": "#1f1b17",
                    "surface-tint": "#2b6954",
                    "on-primary": "#ffffff",
                    "tertiary-fixed": "#e2e2e2",
                    "primary-fixed-dim": "#95d3ba",
                    "on-surface-variant": "#404944",
                    "on-primary-fixed-variant": "#0b513d",
                    "background": "#fff8f5",
                    "error": "#ba1a1a",
                    "primary-fixed": "#b0f0d6",
                    "error-container": "#ffdad6",
                    "tertiary": "#2d2f2e",
                    "on-primary-fixed": "#002117",
                    "on-tertiary-container": "#b1b2b1",
                    "surface-container-high": "#f0e6e0",
                    "on-primary-container": "#80bea6",
                    "surface-variant": "#eae1da",
                    "on-error": "#ffffff",
                    "outline": "#707974",
                    "surface-container-lowest": "#ffffff",
                    "surface-container": "#f6ece6",
                    "secondary-fixed": "#6ffbbe",
                    "on-tertiary": "#ffffff",
                    "secondary-fixed-dim": "#4edea3",
                    "secondary": "#006c49",
                    "inverse-surface": "#342f2b",
                    "surface-container-highest": "#eae1da",
                    "on-tertiary-fixed-variant": "#454747",
                    "on-secondary-fixed-variant": "#005236",
                    "on-tertiary-fixed": "#1a1c1c",
                    "surface": "#fff8f5",
                    "on-secondary-container": "#00714d",
                    "inverse-primary": "#95d3ba",
                    "on-secondary": "#ffffff",
                    "on-surface": "#1f1b17",
                    "on-error-container": "#93000a",
                    "secondary-container": "#6cf8bb",
                    "tertiary-fixed-dim": "#c6c7c6",
                    "outline-variant": "#bfc9c3",
                    "surface-dim": "#e2d8d2",
                    "primary-container": "#064e3b",
                    "primary": "#003527"
            },
            "borderRadius": {
                    "DEFAULT": "1rem",
                    "lg": "2rem",
                    "xl": "3rem",
                    "full": "9999px"
            },
            "fontFamily": {
                    "headline": ["Manrope"],
                    "body": ["Inter"],
                    "label": ["Inter"]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editor-canvas:empty:before {
            content: attr(data-placeholder);
            color: #707974;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">
<!-- TopNavBar Component -->
<nav class="fixed top-0 w-full z-50 bg-[#fff8f5]/80 backdrop-blur-xl shadow-[0px_20px_40px_rgba(31,27,23,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
<!-- Brand -->
<div class="text-2xl font-bold text-[#003527] font-headline tracking-tight">EcoDon</div>
<!-- Navigation Links -->
<div class="hidden md:flex gap-8 items-center">
<a class="text-[#1f1b17] hover:text-[#006c49] transition-colors duration-300 font-headline tracking-tight" href="#">Impact</a>
<a class="text-[#1f1b17] hover:text-[#006c49] transition-colors duration-300 font-headline tracking-tight" href="#">Organizations</a>
<a class="text-[#006c49] font-bold border-b-2 border-[#006c49] pb-1 font-headline tracking-tight" href="#">Blog</a>
</div>
<!-- Actions -->
<div class="flex items-center gap-4">
<button class="px-6 py-2 rounded-full font-headline font-bold text-[#003527] scale-95 active:opacity-80 transition-all">Sign In</button>
<button class="px-6 py-2 rounded-full font-headline font-bold bg-primary text-white scale-95 active:opacity-80 transition-all shadow-md">Join Now</button>
</div>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="pt-28 pb-12 px-6 max-w-7xl mx-auto">
<form action="/organization/blog" method="POST">
    @csrf
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- Left Column: Editor -->
<div class="lg:col-span-8 space-y-6">
<!-- Header Actions Mobile -->
<div class="flex lg:hidden justify-between items-center mb-4">
<h2 class="font-headline text-xl font-bold text-primary">Editor</h2>
<div class="flex gap-2">
<button class="p-2 rounded-full bg-surface-container text-on-surface"><span class="material-symbols-outlined">save</span></button>
<button class="px-4 py-2 bg-primary text-white rounded-full font-bold">Publish</button>
</div>
</div>
<!-- Title Input Module -->
<div class="bg-surface-container rounded-lg p-6">
<input name="title" class="w-full bg-transparent border-none focus:ring-0 text-3xl md:text-4xl font-headline font-extrabold text-primary placeholder-outline-variant p-0" placeholder="Enter post title..." type="text"/>
</div>
<!-- Rich Text Editor Module -->
<div class="bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm border border-outline-variant/15">
<!-- Toolbar -->
<div class="flex flex-wrap items-center gap-1 p-3 bg-surface-container-low border-b border-outline-variant/10">
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">format_bold</span></button>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">format_italic</span></button>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">format_underlined</span></button>
<div class="h-6 w-[1px] bg-outline-variant/30 mx-1"></div>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">format_list_bulleted</span></button>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">format_list_numbered</span></button>
<div class="h-6 w-[1px] bg-outline-variant/30 mx-1"></div>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">image</span></button>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">link</span></button>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">format_quote</span></button>
<div class="flex-grow"></div>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">undo</span></button>
<button class="p-2 hover:bg-surface-container-high rounded-lg transition-colors text-on-surface-variant"><span class="material-symbols-outlined">redo</span></button>
</div>
<!-- Content Area -->
<div class="editor-canvas min-h-[500px] p-8 focus:outline-none text-lg leading-relaxed text-on-surface-variant font-body" contenteditable="true" data-placeholder="Tell your eco-story...">
<p>Begin typing your article here. Share the latest sustainability breakthroughs or local conservation efforts...</p>
<br/>
<div class="my-8 rounded-lg overflow-hidden relative group">
<img class="w-full h-80 object-cover" data-alt="lush green forest floor with small sprout growing through moss in soft morning sunlight" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3GEi6p6eL4Luk-DNT88gFJ0n8bAVHsAqIzrUwdCDIFBdY5bTDrLB_spH1ANFVN28P9Dzy-W6Rnehj84SwWuGmd5DWdj3EE5sHY8v1V2EwVtgz3WmHhfycKNd2yBtSvm3wSrA40TrZXa_F7jDbWUNZsuokBRAMz6TPv4rDdLoa_A2be2Z90gA2mCqnPnnNlZqkLdrDe8HXf3rU_6oR7or3DHOVT8_beM4IfR7hxBlkzawEBhfWEKDW0l9GCLs4vI-akOo4OpHwVtk7"/>
<div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all"></div>
<p class="text-sm text-outline italic mt-2 text-center">Caption: New life emerging in the Digital Arboretum.</p>
</div>
<input type="hidden" name="content" id="content">
</div>
</div>
</div>
<!-- Right Column: Settings Panel -->
<aside class="lg:col-span-4 space-y-6">
<!-- Desktop Publish Actions -->
<div class="hidden lg:flex gap-3 justify-end mb-4">
<button class="px-6 py-2.5 rounded-full font-headline font-bold text-primary bg-surface-container-high hover:bg-surface-container-highest transition-all">Save Draft</button>
<button type="submit" onclick="setContent()" class="px-8 py-2.5 rounded-full font-headline font-bold bg-primary text-white">
    Publish
</button>
</div>
<!-- Settings Card -->
<div class="bg-surface-container rounded-lg p-6 space-y-8">
<h3 class="font-headline text-lg font-bold text-primary border-b border-outline-variant/15 pb-4">Post Settings</h3>
<!-- Categories -->
<div class="space-y-3">
<label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider block">Categories</label>
<div class="grid grid-cols-1 gap-2">
<label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-surface-container-high transition-colors">
<input checked="" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/20" type="checkbox"/>
<span class="text-on-surface">Sustainability</span>
</label>
<label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-surface-container-high transition-colors">
<input class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/20" type="checkbox"/>
<span class="text-on-surface">Community</span>
</label>
<label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-surface-container-high transition-colors">
<input class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/20" type="checkbox"/>
<span class="text-on-surface">Technology</span>
</label>
</div>
</div>
<!-- Tags -->
<div class="space-y-3">
<label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider block">Tags</label>
<div class="relative">
<input class="w-full bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary/20 p-3 placeholder-outline-variant" placeholder="Add tag..." type="text"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary font-bold">Add</button>
</div>
<div class="flex flex-wrap gap-2 pt-2">
<span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                #eco-friendly <span class="material-symbols-outlined text-[14px]">close</span>
</span>
<span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                #carbon-offset <span class="material-symbols-outlined text-[14px]">close</span>
</span>
</div>
</div>
<!-- Publishing Date -->
<div class="space-y-3">
<label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider block">Publishing Date</label>
<div class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg border border-transparent focus-within:border-primary/20">
<span class="material-symbols-outlined text-outline">calendar_today</span>
<input class="bg-transparent border-none focus:ring-0 p-0 text-on-surface w-full" type="date" value="2024-05-24"/>
</div>
<p class="text-[11px] text-outline px-1">Choose 'Immediate' to publish as soon as you hit the button.</p>
</div>
<!-- Featured Image -->
<div class="space-y-3 pt-4 border-t border-outline-variant/15">
<label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider block">Featured Image</label>
<div class="aspect-video rounded-lg bg-surface-container-low border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-surface-container-high transition-all">
<span class="material-symbols-outlined text-outline-variant text-4xl">add_photo_alternate</span>
<span class="text-xs text-outline font-medium">Click to upload or drag &amp; drop</span>
</div>
</div>
</div>
<!-- Footer Links -->
<div class="px-6 flex justify-between text-xs text-outline font-medium">
<a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-primary transition-colors" href="#">Editor Help</a>
</div>
</aside>
</div>
</form>
</main>
<!-- Footer Component -->
<footer class="bg-primary mt-12 w-full py-12 px-8">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
<div class="space-y-4">
<div class="text-lg font-bold text-white font-headline">EcoDon</div>
<p class="text-stone-400 text-sm font-body leading-relaxed">Protecting our digital arboretum through sustainable design and conscious choices.</p>
</div>
<div class="space-y-4">
<h4 class="text-white font-bold text-sm uppercase tracking-widest">Resources</h4>
<ul class="space-y-2 text-stone-400 text-sm">
<li><a class="hover:text-[#006c49] transition-colors" href="#">Privacy Policy</a></li>
<li><a class="hover:text-[#006c49] transition-colors" href="#">Terms of Service</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="text-white font-bold text-sm uppercase tracking-widest">Platform</h4>
<ul class="space-y-2 text-stone-400 text-sm">
<li><a class="hover:text-[#006c49] transition-colors" href="#">Sustainability Report</a></li>
<li><a class="hover:text-[#006c49] transition-colors" href="#">Impact Tracking</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="text-white font-bold text-sm uppercase tracking-widest">Contact</h4>
<ul class="space-y-2 text-stone-400 text-sm">
<li><a class="hover:text-[#006c49] transition-colors" href="#">Support Center</a></li>
<li><a class="hover:text-[#006c49] transition-colors" href="#">Press Kit</a></li>
</ul>
</div>
</div>
<div class="max-w-7xl mx-auto mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
<p class="text-stone-400 text-sm font-body">© 2024 EcoDon. Protecting our digital arboretum.</p>
<div class="flex gap-6">
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-white transition-colors">language</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-white transition-colors">hub</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-white transition-colors">potted_plant</span>
</div>
</div>
</footer>
<script>
function setContent() {
    document.getElementById('content').value =
        document.querySelector('.editor-canvas').innerHTML;
}
</script>
</body></html>