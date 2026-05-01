@extends('layouts.admin')

@section('title', 'System Configuration')

@section('content')
<div class="max-w-screen-xl mx-auto">
    <!-- Header Protocol -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-px bg-primary-500"></div>
                <p class="text-[10px] font-black text-primary-500 uppercase tracking-[0.5em]">System Node MC-012</p>
            </div>
            <h3 class="font-black text-4xl text-white uppercase tracking-tighter italic leading-none">Settings Control <span class="text-primary-500">.</span></h3>
            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-[0.3em] mt-3">Governance & Global Parameter Synchronization</p>
        </div>
        
        <div class="flex gap-3">
            <div class="px-5 py-3 bg-white/[0.02] border border-white/5 rounded-2xl backdrop-blur-md">
                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1 text-center">Core Status</p>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Active</p>
                </div>
            </div>
            <div class="px-5 py-3 bg-white/[0.02] border border-white/5 rounded-2xl backdrop-blur-md">
                <p class="text-[8px] font-black text-gray-600 uppercase tracking-widest mb-1 text-center">Data Node</p>
                <p class="text-[10px] font-black text-primary-400 uppercase tracking-widest">Central</p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 p-5 mb-10 rounded-3xl text-[10px] font-black uppercase tracking-widest flex items-center gap-4 animate-slide-in shadow-[0_0_50px_-12px_rgba(16,185,129,0.2)]">
        <div class="w-8 h-8 rounded-xl bg-emerald-500/20 flex items-center justify-center shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3"/></svg>
        </div>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex flex-col lg:flex-row gap-10 items-start">
            <!-- Navigation Matrix -->
            <div class="w-full lg:w-72 shrink-0 space-y-3 sticky top-8">
                <p class="text-[9px] font-black text-gray-600 uppercase tracking-[0.4em] ml-4 mb-4">Functional Groups</p>
                @foreach($settings as $group => $items)
                <button type="button" 
                        onclick="switchTab('tab-{{ $group }}')"
                        id="btn-tab-{{ $group }}"
                        class="tab-btn w-full px-6 py-5 rounded-[1.5rem] border border-transparent flex items-center justify-between group transition-all duration-500 hover:bg-white/[0.02]">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] {{ $group === 'general' ? 'text-primary-500' : 'text-gray-500' }} group-hover:text-white transition-colors">{{ str_replace('_', ' ', $group) }}</span>
                    <div class="w-1.5 h-1.5 rounded-full {{ $group === 'general' ? 'bg-primary-500 shadow-[0_0_15px_rgba(79,70,229,0.6)]' : 'bg-white/5' }} transition-all duration-500 group-hover:scale-150"></div>
                </button>
                @endforeach

                <div class="pt-10">
                    <button type="submit" 
                            class="glow-button group w-full relative inline-flex items-center justify-center gap-3 bg-primary-600 hover:bg-primary-500 text-white font-black py-5 rounded-[1.5rem] transition-all hover:shadow-[0_0_50px_-10px_rgba(79,70,229,0.6)] active:scale-95 uppercase tracking-[0.3em] text-[10px] overflow-hidden">
                        <div class="absolute inset-0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
                        Sync Global
                    </button>
                    <p class="text-[8px] font-black text-gray-700 uppercase tracking-widest text-center mt-4 italic">Commit changes to all nodes</p>
                </div>
            </div>

            <!-- Parameter Workspace -->
            <div class="flex-1 w-full">
                @foreach($settings as $group => $items)
                <div id="tab-{{ $group }}" class="tab-content {{ $group === 'general' ? '' : 'hidden' }} animate-fade-in">
                    <div class="glass-dark border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl relative">
                        <!-- Top Accent Bar -->
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary-600/50 via-violet-600/50 to-primary-600/50"></div>
                        
                        <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex items-center justify-between">
                            <div>
                                <h4 class="text-[13px] font-black text-white uppercase tracking-[0.5em] italic">{{ str_replace('_', ' ', $group) }} Registry</h4>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mt-1">Fragment configuration database</p>
                            </div>
                            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-white/5 rounded-full border border-white/5">
                                <div class="w-1 h-1 bg-primary-500 rounded-full"></div>
                                <span class="text-[8px] font-black text-gray-500 uppercase tracking-widest leading-none">Matrix Sync</span>
                            </div>
                        </div>

                        <div class="p-10 space-y-12">
                            @foreach($items as $setting)
                            <div class="group/field grid grid-cols-1 md:grid-cols-12 gap-8">
                                <div class="md:col-span-5">
                                    <label class="block text-[11px] font-black text-white uppercase tracking-widest mb-2 group-hover/field:text-primary-400 transition-colors">
                                        @php
                                            $label = str_replace(['_', 'site'], [' ', ''], $setting->key_name);
                                        @endphp
                                        {{ trim($label) }}
                                    </label>
                                    <p class="text-[9px] font-medium text-gray-500 uppercase tracking-widest leading-relaxed opacity-60 group-hover/field:opacity-100 transition-opacity">
                                        Logical ID: <span class="font-mono text-gray-400">{{ $setting->key_name }}</span>
                                    </p>
                                </div>

                                <div class="md:col-span-7">
                                    @if($setting->type === 'boolean')
                                    <div class="flex items-center h-10">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="{{ $setting->key_name }}" value="1" {{ $setting->value == '1' ? 'checked' : '' }} class="sr-only peer">
                                            <div class="w-16 h-8 bg-black/40 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-gray-600 after:rounded-full after:h-6 after:w-6 after:transition-all duration-300 peer-checked:bg-primary-600/30 peer-checked:after:bg-primary-500 peer-checked:after:shadow-[0_0_20px_rgba(79,70,229,0.8)] border border-white/5"></div>
                                            <span class="ml-4 text-[10px] font-black text-gray-500 uppercase tracking-widest peer-checked:text-primary-400 transition-colors">Binary Protocol</span>
                                        </label>
                                    </div>
                                    @elseif($setting->type === 'text')
                                    <textarea name="{{ $setting->key_name }}" 
                                              class="parameter-input w-full bg-[#0a0a0c] border border-white/10 rounded-2xl px-6 py-5 text-[12px] font-medium text-white tracking-wide focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 placeholder:text-gray-800 transition-all duration-300 min-h-[120px] shadow-inner shadow-black/40">{{ $setting->value }}</textarea>
                                     @elseif($setting->type === 'integer')
                                     <input type="number" name="{{ $setting->key_name }}" value="{{ $setting->value }}"
                                            class="parameter-input w-full md:w-36 bg-[#0a0a0c] border border-white/10 rounded-xl px-6 py-4 text-[13px] font-black text-white tracking-widest focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 placeholder:text-gray-800 transition-all duration-300">
                                     @else
                                     <input type="text" name="{{ $setting->key_name }}" value="{{ $setting->value }}"
                                            class="parameter-input w-full bg-[#0a0a0c] border border-white/10 rounded-xl px-6 py-4 text-[12px] font-bold text-white tracking-wide focus:border-primary-500/50 focus:outline-none focus:ring-4 focus:ring-primary-500/10 placeholder:text-gray-800 transition-all duration-300">
                                     @endif
                                 </div>
                            </div>
                            @if(!$loop->last)
                            <div class="h-px bg-gradient-to-r from-transparent via-white/[0.03] to-transparent"></div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>

<script>
    function switchTab(tabId) {
        // Hide all content with a smooth transition
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Show active content
        const targetContent = document.getElementById(tabId);
        targetContent.classList.remove('hidden');
        
        // Update button styles globally
        document.querySelectorAll('.tab-btn').forEach(btn => {
            const span = btn.querySelector('span');
            const dot = btn.querySelector('div');
            
            btn.classList.remove('bg-white/[0.04]', 'border-white/10', 'shadow-2xl', 'shadow-primary-500/5');
            span.classList.remove('text-primary-500');
            span.classList.add('text-gray-500');
            dot.classList.remove('bg-primary-500', 'shadow-[0_0_15px_rgba(79,70,229,0.6)]', 'scale-125');
            dot.classList.add('bg-white/5');
        });
        
        const activeBtn = document.getElementById('btn-' + tabId);
        const activeSpan = activeBtn.querySelector('span');
        const activeDot = activeBtn.querySelector('div');
        
        activeBtn.classList.add('bg-white/[0.04]', 'border-white/10', 'shadow-2xl', 'shadow-primary-500/5');
        activeSpan.classList.remove('text-gray-500');
        activeSpan.classList.add('text-primary-500');
        activeDot.classList.remove('bg-white/5');
        activeDot.classList.add('bg-primary-500', 'shadow-[0_0_15px_rgba(79,70,229,0.6)]', 'scale-125');
    }

    // Initialize state
    document.addEventListener('DOMContentLoaded', () => {
        switchTab('tab-general');
    });
</script>

@push('scripts')
<style>
    /* Force override any browser/system defaults for these inputs */
    .parameter-input {
        background-color: #030712 !important;
        color: #ffffff !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }
    
    .parameter-input:-webkit-autofill,
    .parameter-input:-webkit-autofill:hover, 
    .parameter-input:-webkit-autofill:focus {
        -webkit-text-fill-color: #ffffff !important;
        -webkit-box-shadow: 0 0 0px 1000px #030712 inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>
@endpush
@endsection
