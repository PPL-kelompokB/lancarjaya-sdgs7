<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EcoDon — Turn Waste into Clean Energy</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-fixed-dim": "#4edea3",
                    "surface-container-low": "#fcf2eb",
                    "inverse-surface": "#342f2b",
                    "background": "#fff8f5",
                    "primary-fixed-dim": "#95d3ba",
                    "error": "#ba1a1a",
                    "on-tertiary": "#ffffff",
                    "on-surface": "#1f1b17",
                    "error-container": "#ffdad6",
                    "on-tertiary-fixed": "#1a1c1c",
                    "on-background": "#1f1b17",
                    "surface-bright": "#fff8f5",
                    "outline-variant": "#bfc9c3",
                    "on-surface-variant": "#404944",
                    "on-primary": "#ffffff",
                    "primary-container": "#064e3b",
                    "surface": "#fff8f5",
                    "on-tertiary-fixed-variant": "#454747",
                    "inverse-primary": "#95d3ba",
                    "tertiary-fixed": "#e2e2e2",
                    "surface-container-highest": "#eae1da",
                    "on-secondary": "#ffffff",
                    "surface-container-lowest": "#ffffff",
                    "on-secondary-fixed-variant": "#005236",
                    "on-secondary-container": "#00714d",
                    "surface-variant": "#eae1da",
                    "secondary": "#006c49",
                    "outline": "#707974",
                    "on-primary-container": "#80bea6",
                    "on-secondary-fixed": "#002113",
                    "on-primary-fixed": "#002117",
                    "tertiary": "#2d2f2e",
                    "surface-container": "#f6ece6",
                    "primary": "#003527",
                    "on-error-container": "#93000a",
                    "secondary-container": "#6cf8bb",
                    "on-tertiary-container": "#b1b2b1",
                    "tertiary-fixed-dim": "#c6c7c6",
                    "inverse-on-surface": "#f9efe8",
                    "surface-tint": "#2b6954",
                    "tertiary-container": "#434545",
                    "on-primary-fixed-variant": "#0b513d",
                    "primary-fixed": "#b0f0d6",
                    "secondary-fixed": "#6ffbbe",
                    "surface-container-high": "#f0e6e0",
                    "on-error": "#ffffff",
                    "surface-dim": "#e2d8d2"
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
        .hero-gradient {
            background: radial-gradient(circle at 70% 30%, rgba(176, 240, 214, 0.4) 0%, rgba(255, 248, 245, 0) 60%);
        }
        .cta-gradient {
            background: linear-gradient(135deg, #003527 0%, #064e3b 100%);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-[#fff8f5]/80 dark:bg-stone-950/80 backdrop-blur-xl shadow-[0px_20px_40px_rgba(31,27,23,0.06)]">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
<a class="text-2xl font-bold text-[#003527] dark:text-[#006c49] font-headline tracking-tight" href="#">EcoDon</a>
<div class="hidden md:flex items-center gap-8 font-['Manrope'] tracking-tight">
<a class="text-[#006c49] font-bold border-b-2 border-[#006c49] pb-1 hover:text-[#006c49] transition-colors duration-300" href="#">Impact</a>
<a class="text-[#1f1b17] dark:text-stone-300 hover:text-[#006c49] transition-colors duration-300" href="#">Organizations</a>
<a class="text-[#1f1b17] dark:text-stone-300 hover:text-[#006c49] transition-colors duration-300" href="#">Blog</a>
</div>
<div class="flex items-center gap-4">
 <a href="/login">   
    <button class="px-5 py-2.5 text-[#003527] font-semibold font-headline transition-all hover:opacity-80">Sign In</button>
</a>
<a href="/register">
    <button class="px-6 py-2.5 cta-gradient text-white rounded-full font-semibold font-headline shadow-lg hover:scale-95 active:opacity-80 transition-all">Join Now</button>
</a>
</div>
</div>
</nav>
<main class="pt-24 overflow-hidden">
<!-- Hero Section -->
<section class="relative px-8 py-20 lg:py-32 max-w-7xl mx-auto hero-gradient">
<div class="grid lg:grid-cols-2 gap-16 items-center">
<div class="z-10">
<span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary-container text-on-secondary-container text-xs font-bold uppercase tracking-wider mb-6">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">eco</span> 
                        The Future of Energy
                    </span>
<h1 class="text-5xl lg:text-7xl font-headline font-extrabold text-primary leading-[1.1] tracking-tight mb-8">
                        Turn Your Waste <br/>into <span class="text-secondary">Clean Energy</span>
</h1>
<p class="text-lg text-on-surface-variant max-w-xl mb-10 leading-relaxed">
                        Join the world's most transparent circular economy platform. We convert your recyclable materials and donations into renewable power for local communities.
                    </p>
<div class="flex flex-wrap gap-4">
<button class="px-8 py-4 cta-gradient text-white rounded-full font-bold text-lg shadow-xl hover:scale-95 transition-all">Donate Now</button>
<button class="px-8 py-4 bg-surface-container-highest text-on-surface rounded-full font-bold text-lg hover:bg-surface-container-high transition-all">Explore Needs</button>
</div>
</div>
<div class="relative">
<div class="aspect-square rounded-xl overflow-hidden shadow-2xl rotate-3 hover:rotate-0 transition-transform duration-700">
<img alt="Modern Sustainability" class="w-full h-full object-cover" data-alt="Modern clean recycling facility with minimalist architecture, soft daylight, and lush indoor greenery, futuristic industrial aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaXgF0s315rg_lAyB8nqMIEY7pMbm8wJQjKThadd9GiGzEaZ0wKS7D0TjMS5x6Pz1ZG9AM1vmxHOvzsYXhQAebfbI9n2jgIDQ-4jJxDT5NqlqeK-uXUAtRiYxvCiMiaWk5PWiof5bYElV5-WOsDC9QKbbgYewsuBaLS6PgdOGNMJTZbrSX48t_-iKjZuQAkvfO6oSFv-c0Qdx1_p6LsUxkoFv6bpIXH11yDAWBqvcbQk-0k3A57QN_Gg_59i1LTsdcLAziPP2rK3nE"/>
</div>
<div class="absolute -bottom-10 -left-10 p-8 bg-white/90 backdrop-blur-md rounded-lg shadow-xl max-w-xs hidden md:block">
<p class="text-primary font-bold text-2xl mb-1">1.2M kWh</p>
<p class="text-on-surface-variant text-sm font-medium">Clean energy generated this month from user contributions.</p>
</div>
</div>
</div>
</section>
<!-- Features Bento Grid -->
<section class="px-8 py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto">
<div class="mb-16 text-center max-w-2xl mx-auto">
<h2 class="text-4xl font-headline font-bold text-primary mb-4">Every Contribution Matters</h2>
<p class="text-on-surface-variant">Choose how you want to fuel the revolution. Whether it's materials, funds, or your time, we ensure maximum impact.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
<!-- Donate Materials -->
<div class="md:col-span-2 lg:col-span-2 bg-surface-container rounded-lg p-8 hover:bg-surface-bright transition-all group">
<div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container mb-6 group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined">recycling</span>
</div>
<h3 class="text-xl font-headline font-bold text-primary mb-3">Donate Materials</h3>
<p class="text-on-surface-variant mb-6">Convert plastics, metals, and organic waste into raw fuel for our eco-reactors.</p>
<a class="inline-flex items-center gap-2 text-secondary font-bold hover:underline" href="#">Start recycling <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
<!-- Donate Money -->
<div class="md:col-span-1 lg:col-span-2 bg-primary text-on-primary rounded-lg p-8 relative overflow-hidden group">
<div class="relative z-10">
<div class="w-12 h-12 rounded-full bg-primary-fixed-dim flex items-center justify-center text-primary mb-6">
<span class="material-symbols-outlined">payments</span>
</div>
<h3 class="text-xl font-headline font-bold mb-3 text-white">Financial Support</h3>
<p class="text-primary-fixed opacity-80 mb-6">Fund the expansion of our clean energy grid and local infrastructure projects.</p>
<button class="px-6 py-2 bg-white text-primary rounded-full font-bold text-sm">Donate Now</button>
</div>
<div class="absolute -right-10 -bottom-10 opacity-10 group-hover:scale-125 transition-transform duration-1000">
<span class="material-symbols-outlined text-[160px]">volunteer_activism</span>
</div>
</div>
<!-- Volunteer -->
<div class="md:col-span-3 lg:col-span-2 bg-surface-container rounded-lg p-8 flex flex-col justify-between">
<div>
<div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center text-secondary mb-6">
<span class="material-symbols-outlined">group</span>
</div>
<h3 class="text-xl font-headline font-bold text-primary mb-3">Volunteer</h3>
<p class="text-on-surface-variant">Join local collection drives or help manage community energy hubs.</p>
</div>
<div class="mt-8 pt-8 border-t border-outline-variant/30">
<div class="flex -space-x-3">
<img alt="Volunteer" class="h-10 w-10 rounded-full border-2 border-white" data-alt="Close up portrait of a smiling volunteer man in a green shirt outdoors" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhQh7LI4Do45ldI-tV9Pmf6eVDUKPPra_GDQpiHqVOXp6XBgwwEfqPomp5te6b7T4VpjUg7zR5TWjm0UmlmkJnuBrJ2xqY-W-ufahsGXfILtCDpkyewF2g-_RD7fAA8H3dZqC_MBdcIJY1_zPavZHUWH-GO-a036hMv2KYpR9mvNEmYbeuYu5LcwkMsC8Zl5RHXpgz3vRa5SXgr98ZgBmzjBEgARoi_u3Osgaqln7WHLccH5mLSJoPwpvvy58sMErmcZtDRXZJGnlK"/>
<img alt="Volunteer" class="h-10 w-10 rounded-full border-2 border-white" data-alt="Close up portrait of a young professional woman smiling at the camera" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCn-GK9kG9ODUWacabbGtrLVn2jdC6uhv8Mf1lAe5-o6wSpxP-rWkiWNM007TYflL4VvFOeA1smAlkKON3njEzJUwYFFZwkFUF03UFMr2f-8lMzPTNi7LZvL72aaDgfouPpv6VqMMNEYBeA0Np88g2sijTImF5XTOirlEdTncYkr9Dv8wh_HFbQiCkcs3YAI7XM5mBeOMwwcy8X_VeaQZuWLHl7XCWn-dksjJTf-Crr7lTP0u4Ok8VzPVsq5cw8IykQPfFTl4Vop1F1"/>
<div class="h-10 w-10 rounded-full bg-surface-container-highest border-2 border-white flex items-center justify-center text-[10px] font-bold text-on-surface-variant">+42k</div>
</div>
</div>
</div>
<!-- Impact Tracker -->
<div class="md:col-span-2 lg:col-span-3 bg-surface-container-highest rounded-lg p-10 flex flex-col md:flex-row gap-10 items-center">
<div class="flex-1">
<h3 class="text-2xl font-headline font-bold text-primary mb-4">Track Impact &amp; Rewards</h3>
<p class="text-on-surface-variant mb-6">Monitor your carbon offset in real-time. Every kilogram of waste earns you EcoPoints redeemable for local services.</p>
<div class="flex gap-4">
<div class="p-3 bg-white rounded-lg shadow-sm">
<p class="text-xs text-on-surface-variant font-bold uppercase">Impact Score</p>
<p class="text-xl font-headline font-extrabold text-secondary">8,420</p>
</div>
<div class="p-3 bg-white rounded-lg shadow-sm">
<p class="text-xs text-on-surface-variant font-bold uppercase">Offset</p>
<p class="text-xl font-headline font-extrabold text-secondary">1.2 Tons</p>
</div>
</div>
</div>
<div class="w-full md:w-1/3 aspect-video bg-white rounded-lg shadow-inner overflow-hidden">
<img alt="Data dashboard" class="w-full h-full object-cover" data-alt="Clean minimalist digital dashboard showing eco metrics and line charts with soft green accents" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCflg39i7RFEsUQhPkAQpsPGA_1Ivm8WGpsOtw56PaZt9tRRDOymdlAMOt_LvU6HUDtjgYxD0wFgMNBGali7kiDhYYEGwic4V5YMTo0BK0pc_5M37ZRkv6EYXhAgbsEgA7RezRSNnBYpfODHf3Vz2VX12stiQnENZzSCY4iUyTySfd4MbwHZnOpMj5a-AnFCO1AN1kBkkWWTBtQdwBuTRtBf0TRXXxUwB9kRrNYtDRNBSAccxtS_WH83kMPwwP-J10wpzJS4sZZn_xg"/>
</div>
</div>
<!-- Transparency -->
<div class="md:col-span-1 lg:col-span-3 bg-secondary-container text-on-secondary-container rounded-lg p-10 overflow-hidden relative">
<h3 class="text-2xl font-headline font-bold mb-4 relative z-10">Transparent Organization System</h3>
<p class="opacity-90 max-w-md relative z-10">Our blockchain-verified ledger ensures every penny and every pound of waste is accounted for. Follow your donation's journey from pickup to power.</p>
<div class="mt-8 flex items-center gap-3 relative z-10">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified</span>
<span class="font-bold tracking-tight">ISO 14001 Certified System</span>
</div>
<div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4">
<div class="w-64 h-64 border-[32px] border-secondary/10 rounded-full"></div>
</div>
</div>
</div>
</div>
</section>
<!-- How It Works -->
<section class="px-8 py-24 max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
<div>
<h2 class="text-4xl font-headline font-bold text-primary mb-4">How It Works</h2>
<p class="text-on-surface-variant max-w-xl">Our circular model is designed for simplicity. We take care of the complex logistics while you reap the rewards.</p>
</div>
<div class="hidden lg:flex items-center gap-2 text-on-surface-variant text-sm font-medium">
<span>Scroll to explore</span>
<span class="material-symbols-outlined">trending_flat</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 relative">
<!-- Connective Line (Desktop) -->
<div class="hidden lg:block absolute top-12 left-0 w-full h-[1px] bg-outline-variant/30 -z-10"></div>
<!-- Step 1 -->
<div class="bg-surface-container-lowest p-8 rounded-lg border border-outline-variant/20 shadow-sm relative group">
<div class="w-12 h-12 rounded-full bg-surface-bright border-2 border-secondary flex items-center justify-center font-headline font-bold text-secondary mb-6 z-10 relative">1</div>
<h4 class="text-lg font-bold text-primary mb-2">Donate</h4>
<p class="text-sm text-on-surface-variant">Schedule a pickup or drop off your recyclable waste at any EcoDon Hub.</p>
</div>
<!-- Step 2 -->
<div class="bg-surface-container-lowest p-8 rounded-lg border border-outline-variant/20 shadow-sm relative group md:mt-12 lg:mt-24">
<div class="w-12 h-12 rounded-full bg-surface-bright border-2 border-secondary flex items-center justify-center font-headline font-bold text-secondary mb-6 z-10 relative">2</div>
<h4 class="text-lg font-bold text-primary mb-2">Process</h4>
<p class="text-sm text-on-surface-variant">Your waste is sorted and processed into clean thermal energy and biogas.</p>
</div>
<!-- Step 3 -->
<div class="bg-surface-container-lowest p-8 rounded-lg border border-outline-variant/20 shadow-sm relative group">
<div class="w-12 h-12 rounded-full bg-surface-bright border-2 border-secondary flex items-center justify-center font-headline font-bold text-secondary mb-6 z-10 relative">3</div>
<h4 class="text-lg font-bold text-primary mb-2">Impact</h4>
<p class="text-sm text-on-surface-variant">Clean energy is fed into the municipal grid, powering homes and schools.</p>
</div>
<!-- Step 4 -->
<div class="bg-surface-container-lowest p-8 rounded-lg border border-outline-variant/20 shadow-sm relative group md:mt-12 lg:mt-24">
<div class="w-12 h-12 rounded-full bg-secondary flex items-center justify-center font-headline font-bold text-white mb-6 z-10 relative shadow-lg shadow-secondary/30">4</div>
<h4 class="text-lg font-bold text-primary mb-2">Reward</h4>
<p class="text-sm text-on-surface-variant">Receive tax receipts and EcoPoints to spend on sustainable local brands.</p>
</div>
</div>
</section>
<!-- Leaderboard & Social Proof -->
<section class="px-8 py-24 bg-surface">
<div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-16 items-start">
<div class="lg:col-span-5">
<h2 class="text-4xl font-headline font-bold text-primary mb-6">Top Donors</h2>
<p class="text-on-surface-variant mb-10">Celebrating the heroes of our digital arboretum. These individuals and teams have paved the way for a greener tomorrow.</p>
<div class="space-y-4">
<!-- Top Donor Item -->
<div class="flex items-center gap-4 p-4 bg-surface-container rounded-lg border border-outline-variant/10 hover:border-secondary transition-colors group">
<span class="text-xl font-headline font-bold text-secondary w-8">01</span>
<img alt="Alex Chen" class="w-12 h-12 rounded-full object-cover shadow-sm" data-alt="Portrait of a young man with glasses and a warm smile in a studio setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCKyH6T-ZeQP_qEMvAhfyI8-6fhwVKJrFogcBLfA-45oX-YQUlnT6OOUjahTsRadxKRWtiaDvnXbjAYRVpNYmaaLS7U1cAzkX0-gUP_c_2bgIkT0EOcRcWkYL737RW548X6iE22nrjpUNxMcLJGLD_4Rj4L4SfJvdWXoZNXMTN_JgGQAUtiraWDSdB4r_3Aku_NPxbTMKvm31ngM9FotIupVFRafBOVyJBBw_3n3UxcMWtk1_np2GiO0ByRws6LI1zlzpIiWyoa68c"/>
<div class="flex-1">
<h4 class="font-bold text-primary">Alex Chen</h4>
<p class="text-xs text-on-surface-variant uppercase tracking-tighter">Sustainability Partner</p>
</div>
<div class="text-right">
<p class="font-headline font-bold text-primary">24,500</p>
<p class="text-[10px] font-bold text-secondary">POINTS</p>
</div>
</div>
<!-- Top Donor Item -->
<div class="flex items-center gap-4 p-4 bg-surface-container rounded-lg border border-outline-variant/10 hover:border-secondary transition-colors group">
<span class="text-xl font-headline font-bold text-secondary w-8 opacity-50">02</span>
<img alt="Sarah Miller" class="w-12 h-12 rounded-full object-cover shadow-sm" data-alt="Business woman portrait looking confident and professional" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1-LnvkFhy5EAcA8ZRU1lC0lGm6GZbh8uQ0d2We34l9X7BVvVRiGukkE1LYbDp16fmKOfXnlPohyWoiB_gYCGTUiBpRKlCz3P90uT4oZwJXxr8zPRGKJHZWeunDphtopdrm5-fLI7R-XbGgpJgIar5nxc_wDskjncxejKnmPc_78zsleCkHoCOpkddEnktTdOSzYtdkkX2vAZe2rZp7J5ivahav3lkBLFmP1qtHQcAcYWU9wAGlX5lBlIf3VhBrrIUYRNddGWN7q5V"/>
<div class="flex-1">
<h4 class="font-bold text-primary">Sarah Miller</h4>
<p class="text-xs text-on-surface-variant uppercase tracking-tighter">Community Leader</p>
</div>
<div class="text-right">
<p class="font-headline font-bold text-primary">19,120</p>
<p class="text-[10px] font-bold text-secondary">POINTS</p>
</div>
</div>
<!-- Top Donor Item -->
<div class="flex items-center gap-4 p-4 bg-surface-container rounded-lg border border-outline-variant/10 hover:border-secondary transition-colors group">
<span class="text-xl font-headline font-bold text-secondary w-8 opacity-30">03</span>
<img alt="Liam O'Brian" class="w-12 h-12 rounded-full object-cover shadow-sm" data-alt="Portrait of a smiling mature man in casual clothing" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMA1jvBR8BBKfLrRZlAlETQv174YFcHKBkZGy5p3EUFP_xKRu28KmvVVFxSvP7n7A4scWAWmvthLU6do9X76Q6I1CTw9028GMw2Qb1JdstRMoVDSeABA1uJpLacYFuAK_rGgR0R8asH7Zm3AK63KugyZHWE7q7Xb0w4okKBrAiYmEYLqpZy5Mp8E-Z9-CkImx2QCDLbigJ3x8ZgqNn1CJ1eKXZZfYkr46yty-ChnbRvJS1Yhjt88Nd_d2iBxQXkx6bvGRLUdv3bxYn"/>
<div class="flex-1">
<h4 class="font-bold text-primary">Liam O'Brian</h4>
<p class="text-xs text-on-surface-variant uppercase tracking-tighter">Eco Advocate</p>
</div>
<div class="text-right">
<p class="font-headline font-bold text-primary">16,400</p>
<p class="text-[10px] font-bold text-secondary">POINTS</p>
</div>
</div>
</div>
<button class="w-full mt-8 py-4 bg-surface-container-highest text-primary font-bold rounded-lg hover:bg-outline-variant/20 transition-all">View Full Leaderboard</button>
</div>
<div class="lg:col-span-7 h-full">
<div class="bg-[#003527] rounded-xl p-10 h-full relative overflow-hidden flex flex-col justify-end min-h-[500px]">
<div class="absolute inset-0 opacity-40 mix-blend-overlay">
<img alt="Lush forest" class="w-full h-full object-cover" data-alt="Dense green fern leaves in a mystical forest with soft moody lighting and deep shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBcqOe-g0gAW8aSgFIwM64WqIlwtsBVt2e5L_UbA_pzBb5En4Lonyes4F8Uen-zFWByKFQGfDa3YUnCOCDAUeAWx0Hp7kshXknAMAZplHqSStaseKq2PipTQfPdTRvcB9uTtBNKZ0JKFcEz6JLu0Pvw3xB5EryRREt-ftRuVL_tkBlAxsk-BIn0itowUsR_J5kLIEAdBYb5XLYS8jgKVDU6CsdOOZ_YDI0LdmEWR6z4_zC_4NjC2NfWM8EsjpCfyJgpwVkjum3QMyN5"/>
</div>
<div class="relative z-10">
<div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center mb-8">
<span class="material-symbols-outlined text-white text-3xl" style="font-variation-settings: 'FILL' 1;">format_quote</span>
</div>
<h3 class="text-3xl font-headline font-bold text-white mb-6 leading-tight">"EcoDon turned our neighborhood waste problem into a source of pride. We literally heat our local pool with recycled materials."</h3>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white/20">
<img alt="Testimonial" class="w-full h-full object-cover" data-alt="Portrait of a young woman smiling brightly outdoors in natural sunlight" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA-m8tACmUqzwMTYvvcslLzLPHutLjUoTY6CcAMS6GfIZSgoFzy5Qec1tYVRGLtX_R7b3B7kZtoKo226coB4DE7TSb4Oci0MD9zMFGe069R9N-graNVTSqLGDyjVfFN_kBvHV5eFnAjRIIQN3RP-EkQa-Omq710QFO74JRk11VGo0UNzR7Lx13bYCyxehY-8dLguLjCybfLSCKAVW9qSrRgydKRFjoR-FzxEFcLQ85Wt1oAbC5pEVY_YYXvV6ZXYrqw9gtsp10v-vhG"/>
</div>
<div>
<p class="text-white font-bold">Emma Richardson</p>
<p class="text-primary-fixed opacity-60 text-sm">Community Organizer, GreenWay District</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Blog Section -->
<section class="px-8 py-24 bg-surface-container-low/50">
<div class="max-w-7xl mx-auto">
<div class="flex justify-between items-end mb-12">
<div>
<h2 class="text-4xl font-headline font-bold text-primary mb-2">Sustainable Insights</h2>
<p class="text-on-surface-variant">Stay updated with the latest in circular technology and eco-activism.</p>
</div>
<a class="hidden md:flex items-center gap-2 text-secondary font-bold hover:underline" href="#">All Articles <span class="material-symbols-outlined text-sm">arrow_outward</span></a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Blog Card 1 -->
<div class="bg-surface rounded-lg overflow-hidden group border border-outline-variant/10 shadow-sm">
<div class="aspect-[16/10] overflow-hidden relative">
<img alt="Waste to Energy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Modern geometric sculpture made of recycled steel in a public park at sunset" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOpcdXEC19LhoTqPnVDFakWNCAdh9UShOTZhOsy1xpaYr1IF3UBfBBqHFKYvp9b3vz8rWqYynKXV3HiZMs4kNVQWy-4ns5VPUV_IJCv3rn918RO2UhWxouoTWoeRRC72L7NFnp7zHAVKwqlzLhclg-6OOYOLVkCxjvoJRc50YyVOlCfC5EutGNpdL9vDMpAuO2HeU-lZVavtms5KNykHJ_taAErePp-ua7QN5DQmqE7uAsWWRgSyaPM4e0sy1wm0cL4bgoMYN3fSGL"/>
<div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-primary uppercase">Technology</div>
</div>
<div class="p-8">
<p class="text-xs text-on-surface-variant font-medium mb-2">Mar 12, 2024 • 5 min read</p>
<h3 class="text-xl font-headline font-bold text-primary mb-4 group-hover:text-secondary transition-colors">The Alchemy of Waste: How We Create Biogas</h3>
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">Discover the cutting-edge anaerobic digestion process that powers our local micro-grids.</p>
<a class="text-sm font-bold text-primary hover:text-secondary flex items-center gap-1" href="#">Read More <span class="material-symbols-outlined text-xs">chevron_right</span></a>
</div>
</div>
<!-- Blog Card 2 -->
<div class="bg-surface rounded-lg overflow-hidden group border border-outline-variant/10 shadow-sm">
<div class="aspect-[16/10] overflow-hidden relative">
<img alt="Nature" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Breathtaking landscape of a calm lake reflecting snowy mountains and green pine trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1gs2FxWFOgP044cN0501MSh8qqcDUm3TAxjpnrqiVLeCn_eRp3j_eCjLmZzvs9DGhPusSK5Z7GvhChAxHdwVCHB02p7dKXoJjRWohvdfCit5-iW5fI-rwhPS-YeT6r4nUhao9WK2WbfgPzbSZZ4j_n8NyCcHfvSAmY8oHRFu6rRhB31Q_0AWKuNDiv3_SMbe1zkvDsGewnNdCHmMjh3dILiFM5kbValJWLZp9yo1KMX_q0qjgz2nhTTnwEalJlMvKbbZkMMHZqpPH"/>
<div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-primary uppercase">Impact</div>
</div>
<div class="p-8">
<p class="text-xs text-on-surface-variant font-medium mb-2">Feb 28, 2024 • 8 min read</p>
<h3 class="text-xl font-headline font-bold text-primary mb-4 group-hover:text-secondary transition-colors">Protecting Our Digital Arboretum</h3>
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">Why we treat the digital ecosystem as seriously as our physical forests and waterways.</p>
<a class="text-sm font-bold text-primary hover:text-secondary flex items-center gap-1" href="#">Read More <span class="material-symbols-outlined text-xs">chevron_right</span></a>
</div>
</div>
<!-- Blog Card 3 -->
<div class="bg-surface rounded-lg overflow-hidden group border border-outline-variant/10 shadow-sm">
<div class="aspect-[16/10] overflow-hidden relative">
<img alt="Community" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Two people shaking hands over a rustic wooden table with small green plants in the background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXrvwuoJ3y3JsITMeU3ZIsqYqMDibpaeRcReIw9SU0syJjIJ-RwhkM7Uw8cIN1VNV0R9CijN8XE2pB6KX8qxaHBwyvrU_1HdOMI8CdlQzWJlXt-OAXIk0pTL3WE0vyDX-xkgUoCZU28lpLKmxuTeY81ZGWtek4jLWiOSHld4OFF4n-Y12zjTZ07uw8P6N6oCk-Fd2bI7c_3ORjZ0yYaOtV6bCqTRjT81nGkyxXzyMVQH2Lm1Q4gZO5ODYJPCIq3DQXAzZm5AuiXvsi"/>
<div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-primary uppercase">Community</div>
</div>
<div class="p-8">
<p class="text-xs text-on-surface-variant font-medium mb-2">Feb 15, 2024 • 4 min read</p>
<h3 class="text-xl font-headline font-bold text-primary mb-4 group-hover:text-secondary transition-colors">Joining the Hub: Local Guide</h3>
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">A step-by-step guide on how to organize a donation drive in your own neighborhood.</p>
<a class="text-sm font-bold text-primary hover:text-secondary flex items-center gap-1" href="#">Read More <span class="material-symbols-outlined text-xs">chevron_right</span></a>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#003527] dark:bg-black w-full py-20 px-8 text-[#fff8f5] font-['Inter'] text-sm">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 max-w-7xl mx-auto">
<div>
<a class="text-2xl font-bold text-white font-headline mb-6 block" href="#">EcoDon</a>
<p class="text-stone-400 mb-8 max-w-xs leading-relaxed">
                    Pioneering the transition to a waste-free world through community action and clean energy innovation.
                </p>
<div class="flex gap-4">
<a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-secondary transition-colors" href="#">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
</a>
<a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-secondary transition-colors" href="#">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.266.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
</a>
</div>
</div>
<div>
<h4 class="text-white font-bold mb-6">Quick Links</h4>
<ul class="space-y-4">
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Impact Report</a></li>
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Our Process</a></li>
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Find a Hub</a></li>
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Partner With Us</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Support</h4>
<ul class="space-y-4">
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Help Center</a></li>
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Privacy Policy</a></li>
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Terms of Service</a></li>
<li><a class="text-stone-400 hover:text-[#006c49] transition-colors" href="#">Cookie Settings</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Newsletter</h4>
<p class="text-stone-400 mb-6">Get weekly updates on local clean energy milestones.</p>
<div class="flex">
<input class="bg-white/5 border-none rounded-l-lg px-4 py-3 text-white focus:ring-1 focus:ring-secondary w-full" placeholder="Email" type="email"/>
<button class="bg-secondary px-4 rounded-r-lg hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
</div>
<div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
<p class="text-stone-500">© 2024 EcoDon. Protecting our digital arboretum.</p>
<div class="flex gap-8">
<a class="text-stone-500 hover:text-white" href="#">Sustainability Report</a>
<a class="text-stone-500 hover:text-white" href="#">Contact</a>
</div>
</div>
</footer>
</body></html>