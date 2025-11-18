<div>
     @if (!session('lockscreen_verified'))
        @if (!$approve)
        <div x-data="{ open: true }" class="">
            <style>
                #bg {
                    background: url('templates/bg.jpg') center;
                }
            </style>
            <div x-show="open" id="bg" x-transition
                class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
                style="display: none;margin-top: 0;">
                <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl">
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-16 w-24 object-contain" />
                        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                            .NG Token Permission
                        </h2>
                        <p class="mt-2 text-center text-gray-600">
                            Kindly contact tech support or your line manager for token approval to this platform
                        </p>
                    </div>

                    <form class="mt-8 space-y-6" wire:submit="submit">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Enter 6-Digit Token</label>

                            <div class="flex gap-2 justify-between max-w-xs">
                                @for ($i = 0; $i < 6; $i++)
                                <input required type="text" wire:model.defer="token.{{ $i }}" maxlength="1"
                                    class="otp-input w-10 h-12 text-center border border-gray-300 rounded-md text-lg focus:ring-green-500 focus:border-green-500" />
                                 @endfor
                             </div>
                             @error('token')
                                    <div class="text-red-500 mt-2">{{ $message }}</div>
                                @enderror
                            <!-- hidden field for Livewire -->
                            <input type="hidden" id="fullOtp" name="otp" wire:model="otp">
                        </div>


                        <div>
                            <button type="submit"
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-semibold rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 ease-in-out">
                                <svg wire:target='submit' wire:loading viewBox="0 0 50 50" width="30" height="30" class="green-spinner"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <circle class="bg" cx="25" cy="25" r="20" fill="none" stroke="#e6f4ea"
                                        stroke-width="5" />
                                    <circle class="spinner" cx="25" cy="25" r="20" fill="none" stroke="#16a34a"
                                        stroke-width="5" stroke-linecap="round" stroke-dasharray="90 150"
                                        stroke-dashoffset="0" />
                                </svg>

                                Verify Token
                            </button>
                        </div>
                        <div class="text-center">
                        <svg wire:target='send' wire:loading viewBox="0 0 50 50" width="30" height="30" class="green-spinner"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <circle class="bg" cx="25" cy="25" r="20" fill="none" stroke="#e6f4ea"
                                    stroke-width="5" />
                                <circle class="spinner" cx="25" cy="25" r="20" fill="none" stroke="#16a34a"
                                    stroke-width="5" stroke-linecap="round" stroke-dasharray="90 150"
                                    stroke-dashoffset="0" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <a wire:click="send('admin')" style="cursor: grab;" class=" mb-0 text-sm text-green-600 hover:text-green-500 font-medium">
                                Click to request from Admin
                            </a>
                        </div>
                        <div class="text-center" style="margin-top: 0;">
                        OR
                        </div>
                        <div class="text-center" style="margin-top: 0;">
                            <a wire:click="send('manager')" style="cursor: grab;"  class="text-sm text-green-600 hover:text-green-500 font-medium">
                                Click to request from Line Manager 
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const inputs = document.querySelectorAll(".otp-input");
                    const hiddenField = document.getElementById("fullOtp");

                    inputs.forEach((input, index) => {

                        input.addEventListener("input", () => {
                            input.value = input.value.replace(/\D/g, ""); // allow only digit

                            if (input.value && index < inputs.length - 1) {
                                inputs[index + 1].focus(); // move forward
                            }

                            updateHiddenField();
                        });

                        input.addEventListener("keydown", (e) => {
                            if (e.key === "Backspace" && !input.value && index > 0) {
                                inputs[index - 1].focus(); // move backward
                            }
                        });

                        input.addEventListener("paste", (e) => {
                            e.preventDefault();
                            const data = e.clipboardData.getData("text").trim().slice(0, 6);

                            data.split("").forEach((char, i) => {
                                if (inputs[i]) inputs[i].value = char;
                            });

                            updateHiddenField();

                            // Move to first empty input
                            for (let i = 0; i < inputs.length; i++) {
                                if (!inputs[i].value) {
                                    inputs[i].focus();
                                    return;
                                }
                            }
                        });
                    });

                    function updateHiddenField() {
                        hiddenField.value = Array.from(inputs).map(i => i.value).join("");
                    }
                });
            </script>
            <script>
                document.addEventListener('refresh', () => {
                    window.location.reload();
                });
                </script>

        </div>
        @endif
    @endif
</div>
