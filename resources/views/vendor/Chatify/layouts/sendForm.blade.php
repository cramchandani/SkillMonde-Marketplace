    <div class="container">
        <div id="jitsi-iframe-container" style="position: absolute;bottom: 11%;z-index: 9;"></div>
    </div>
<div class="messenger-sendCard" x-data="window.ieFgUjXUHsNGdOd" x-init="initialize">
    
    {{-- Emojis box --}}
    @if (settings('live_chat')->enable_emojis)
        <div id="emojis-box-container" style="display: none"></div>
    @endif

    {{-- Send message form --}}
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data" class="items-center">

        @csrf

        {{-- Emoji container --}}
        @if (settings('live_chat')->enable_emojis)
            <div id="emojis-box-trigger">
                <svg class="emoji-box-trigger-event action-svg w-5 h-5 !text-slate-400 hover:!text-slate-600 dark:!text-slate-200 dark:hover:!text-white focus:outline-none" data-tooltip-target="chat-tooltip-btn-insert-emoji" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
            </div>
            <x-forms.tooltip id="chat-tooltip-btn-insert-emoji" :text="__('messages.t_insert_emoji')" />
        @endif

        {{-- Attach a file --}}
        @if (settings('live_chat')->enable_attachments)
            <label id="attachment-file-btn">
                <svg class="action-svg w-5 h-5 !text-slate-400 hover:!text-slate-600 dark:!text-slate-200 dark:hover:!text-white focus:outline-none" data-tooltip-target="chat-tooltip-btn-insert-file" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                <input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" />
            </label>
            <x-forms.tooltip id="chat-tooltip-btn-insert-file" :text="__('messages.t_attach_a_file')" />
        @endif

        {{-- Message content --}}
        <div class="w-full px-3 flex items-center justify-center border rounded-md">
            <textarea x-model="message" id="live-chat-message-textarea" readonly='readonly' name="message" class="m-send app-scroll dark:placeholder:text-zinc-400" placeholder="@lang('messages.t_type_ur_message_here')"></textarea>
        </div>

        {{-- Send --}}
        <button disabled='disabled' class="focus:outline-none">
            <svg class="action-svg !h-6 !w-6 !text-primary-600 focus:outline-none rtl:-rotate-90 rtl:active:!-rotate-90" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path></g></svg>
        </button>

    </form>

</div>


<?php /* ?>
        <!-- Modal -->
        <div class="modal fade modal-full" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-full modal-dialog-scrollable">
            <div class="modal-content modal-content-full">
              <div class="modal-header">
                <button type="button" class="btn-close bg-gray-600" data-bs-dismiss="modal" aria-label="Close">X</button>
              </div>
              <div class="modal-body" style="height:75vh;">
                <!--<div id="jaas-container" /></div>-->
                <div id="jitsi-container"></div>
              </div>
            </div>
          </div>
        </div>
<?php */ ?>        
<script>
    function ieFgUjXUHsNGdOd() {
        return {

            message     : null,

            // Initialize emojis box
            @if (settings('live_chat')->enable_emojis)
            emojis() {
                
                // Access this
                const _this           = this;

                // Get emoji box container
                const emoji_container = $("#emojis-box-container");

                // Set options
                const options = { 
                    set            : 'twitter',
                    theme          : "{{ current_theme() }}",
                    dynamicWidth   : true,
                    previewPosition: 'none',
                    i18n           : {
                        "rtl"                : {{ config()->get('direction') === 'rtl' ? 1 : 0 }},
                        "search"             : "{{ __('messages.t_search') }}",
                        "search_no_results_1": "{{ __('messages.t_oops') }}",
                        "search_no_results_2": "{{ __('messages.t_no_results_found') }}",
                        "pick"               : "{{ __('messages.t_pick_an_emoji') }}",
                        "add_custom"         : "Add custom emoji",
                        "categories"         : {
                            "activity": "{{ __('messages.t_emojis_activity') }}",
                            "custom"  : "{{ __('messages.t_emojis_custom') }}",
                            "flags"   : "{{ __('messages.t_emojis_flags') }}",
                            "foods"   : "{{ __('messages.t_emojis_food_drink') }}",
                            "frequent": "{{ __('messages.t_emojis_recently_used') }}",
                            "nature"  : "{{ __('messages.t_emojis_animals_nature') }}",
                            "objects" : "{{ __('messages.t_emojis_objects') }}",
                            "people"  : "{{ __('messages.t_emojis_smileys') }}",
                            "places"  : "{{ __('messages.t_emojis_travel') }}",
                            "search"  : "{{ __('messages.t_search_results') }}",
                            "symbols" : "{{ __('messages.t_emojis_symbols') }}"
                        },
                        "skins": {
                            "choose": "{{ __('messages.t_choose_default_skin_tone') }}",
                            "1"     : "{{ __('messages.t_skin_default') }}",
                            "2"     : "{{ __('messages.t_skin_light') }}",
                            "3"     : "{{ __('messages.t_skin_medium_light') }}",
                            "4"     : "{{ __('messages.t_skin_medium') }}",
                            "5"     : "{{ __('messages.t_skin_medium_dark') }}",
                            "6"     : "{{ __('messages.t_skin_dark') }}"
                        }
                    },
                    exceptEmojis: [
                        'relaxed',
                        'smiling_face_with_tear',
                        'face_with_open_eyes_and_hand_over_mouth',
                        'face_with_peeking_eye',
                        'saluting_face',
                        'dotted_line_face',
                        'face_in_clouds',
                        'face_exhaling',
                        'face_with_spiral_eyes',
                        'disguised_face',
                        'face_with_diagonal_mouth',
                        'face_holding_back_tears',
                        'rightwards_hand',
                        'leftwards_hand',
                        'palm_down_hand',
                        'palm_up_hand',
                        'pinched_fingers',
                        'hand_with_index_finger_and_thumb_crossed',
                        'index_pointing_at_the_viewer',
                        'heart_hands',
                        'anatomical_heart',
                        'lungs',
                        'biting_lip',
                        'man_with_beard',
                        'woman_with_beard',
                        'red_haired_person',
                        'curly_haired_person',
                        'white_haired_person',
                        'bald_person',
                        'health_worker',
                        'student',
                        'teacher',
                        'judge',
                        'farmer',
                        'cook',
                        'mechanic',
                        'factory_worker',
                        'office_worker',
                        'scientist',
                        'technologist',
                        'singer',
                        'artist',
                        'pilot',
                        'astronaut',
                        'firefighter',
                        'ninja',
                        'person_with_crown',
                        'man_in_tuxedo',
                        'woman_in_tuxedo',
                        'man_with_veil',
                        'woman_with_veil',
                        'pregnant_man',
                        'pregnant_person',
                        'woman_feeding_baby',
                        'man_feeding_baby',
                        'person_feeding_baby',
                        'mx_claus',
                        'troll',
                        'person_with_probing_cane',
                        'person_in_motorized_wheelchair',
                        'person_in_manual_wheelchair',
                        'people_hugging',
                        'heart_on_fire',
                        'mending_heart',
                        'black_cat',
                        'bison',
                        'mammoth',
                        'beaver',
                        'polar_bear',
                        'dodo',
                        'feather',
                        'seal',
                        'coral',
                        'beetle',
                        'cockroach',
                        'fly',
                        'worm',
                        'lotus',
                        'potted_plant',
                        'empty_nest',
                        'nest_with_eggs',
                        'blueberries',
                        'olive',
                        'bell_pepper',
                        'beans',
                        'flatbread',
                        'tamale',
                        'fondue',
                        'teapot',
                        'pouring_liquid',
                        'bubble_tea',
                        'jar',
                        'magic_wand',
                        'hamsa',
                        'pinata',
                        'mirror_ball',
                        'nesting_dolls',
                        'sewing_needle',
                        'knot',
                        'rock',
                        'wood',
                        'hut',
                        'playground_slide',
                        'pickup_truck',
                        'roller_skate',
                        'wheel',
                        'ring_buoy',
                        'thong_sandal',
                        'military_helmet',
                        'accordion',
                        'long_drum',
                        'low_battery',
                        'coin',
                        'boomerang',
                        'carpentry_saw',
                        'screwdriver',
                        'hook',
                        'ladder',
                        'crutch',
                        'x-ray',
                        'elevator',
                        'mirror',
                        'window',
                        'plunger',
                        'mouse_trap',
                        'bucket',
                        'bubbles',
                        'toothbrush',
                        'headstone',
                        'placard',
                        'identification_card',
                        'heavy_equals_sign',
                        'transgender_flag'
                    ],
                    onClickOutside(e) {

                        // Get target
                        const target = e.target || e.srcElement;

                        // Check if clicked on emoji button
                        if (target.classList.contains('emoji-box-trigger-event')) {

                            // Toggle hidden class
                            emoji_container.toggle();
                            
                        } else {

                            // Hide the box
                            emoji_container.hide();

                        }
                        
                    },
                    onEmojiSelect(selection) {
                        
                        // Insert the emoji
                        _this.message = _this.message + " " + selection.native;

                        // Now focus on the textarea
                        document.getElementById('live-chat-message-textarea').focus();

                    }
                };

                // Set new picker
                const picker = new EmojiMart.Picker(options);

                // Insert html code
                document.getElementById('emojis-box-container').appendChild(picker)

            },
            @endif

            // Initialize
            initialize() {

                @if (settings('live_chat')->enable_emojis)

                // Initialize emojis
                this.emojis();

                // Listen to open/close emoji box
                document.getElementById('emojis-box-trigger').addEventListener('click', function() { 
                    $('#emojis-box-container').toggleClass('hidden');
                }, false);

                @endif

                // Disable Enter button in message box
                $("#live-chat-message-textarea").keydown(function(e){
                    if (e.keyCode == 13 && !e.shiftKey) {
                        e.preventDefault();
                        return false;
                    }
                });

            }

        }
    }
    window.ieFgUjXUHsNGdOd = ieFgUjXUHsNGdOd();
</script>

<script>
    // Get the text area element
    const textarea = document.getElementById('live-chat-message-textarea');
    
    // Add an event listener to detect when the user pastes or types in the text area
    textarea.addEventListener('input', function() {
      // Get the text content of the text area
      const text = textarea.value;
    
      // Regular expressions for detecting email addresses, phone/mobile numbers, and bank account numbers
     // const emailRegex = /\S+@\S+\.\S+/;
      
      const emailRegex = /(\S+@\S+\.\S+)|(\S+\[at]\S+\[dot]\S+)/;

      //const phoneRegex = /\d{10,}/;
      const phoneRegex = /(\+?91[\-\.\s]?)?[2-9]\d{9}|(\+?1[\-\.\s]?)?\(?[2-9][0-9]{2}\)?[\-\.\s]?[0-9]{3}[\-\.\s]?[0-9]{4}|(\+?61[\-\.\s]?)?\(?(0?[2-57-8])\)?[\-\.\s]?[0-9]{4}[\-\.\s]?[0-9]{4}|(\+?44[\-\.\s]?)?\(?0?\d{4}\)?[\-\.\s]?\d{3}[\-\.\s]?\d{3}|(\+?7[\-\.\s]?)?(\d{3}[\-\.\s]?){2}\d{2}|\+86[\-\.\s]?1[3456789]\d{9}|(\+?92[\-\.\s]?)?3\d{9}|(\+?880[\-\.\s]?)?((\d{10})|(1\d{9}))|(\+?90[\-\.\s]?)?0?5\d{9}/;

      const bankAccountRegex = /(\b\d{8}(?:\d{2})?\b)|(\b\d{2}-\d{4}-\d{7}-\d{2}\b)|(\b\d{3}-\d{7}-\d{1}\b)|(\b\d{7}-\d{1}\b)|(\b\d{10}\b)|(\b\d{12}\b)|(\b\d{16}\b)|(\b\d{4}.\d{4}.\d{4}.\d{4}\b)/;
      const mobileRegex = /(\+?91[\-\.\s]?)?[2-9]\d{9}|(\+?1[\-\.\s]?)?\(?[2-9][0-9]{2}\)?[\-\.\s]?[0-9]{3}[\-\.\s]?[0-9]{4}|(\+?61[\-\.\s]?)?\(?(0?[2-57-8])\)?[\-\.\s]?[0-9]{4}[\-\.\s]?[0-9]{4}|(\+?44[\-\.\s]?)?\(?0?\d{4}\)?[\-\.\s]?\d{3}[\-\.\s]?\d{3}|(\+?7[\-\.\s]?)?(\d{3}[\-\.\s]?){2}\d{2}|\+86[\-\.\s]?1[3456789]\d{9}|(\+?92[\-\.\s]?)?3\d{9}|(\+?880[\-\.\s]?)?((\d{10})|(1\d{9}))|(\+?90[\-\.\s]?)?0?5\d{9}/;

      // Detect and remove any email addresses, phone/mobile numbers, or bank account numbers from the text content
      const filteredText = text.replace(emailRegex, '').replace(phoneRegex, '').replace(bankAccountRegex, '').replace(mobileRegex, '');
    
      // If email, phone number, or bank account number detected, alert the user
      if (text !== filteredText) {
        alert("Oops! It looks like you've included some sensitive information in your message. Please remove any traces of email addresses, phone numbers, or bank account numbers before sending.");
      }
    
      // Update the text area with the final filtered text content
      textarea.value = filteredText;
    });
    
</script>


<script>
  let api;
  
  const randomNumber = Math.floor(Math.random() * 1000);
  const randomLetters = Math.random().toString(36).substring(2, 6);
  const roomName = `skillmonde-meeting-room-for-{{ auth()->user()->username }}-${randomNumber}${randomLetters}`;


  function startVideoChat() {
    const domain = 'meet.jit.si';
    const options = {
      roomName: roomName,
      width: '600px',
      height: '400px',
      parentNode: document.getElementById('jitsi-iframe-container'),
      userInfo: {
        displayName: '{{ auth()->user()->username }}',
      },
      configOverwrite: {
        enableWelcomePage: false,
      },
      interfaceConfigOverwrite: {
        SHOW_BRAND_WATERMARK: true,
        JITSI_WATERMARK_LINK: 'https://skillmonde.com/public/img/assets/logo.png',
        DISABLE_FOCUS_INDICATOR: true,
        TOOLBAR_BUTTONS: [
          'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
          'fodeviceselection', 'profile', 'chat',
          'whiteboard', 'settings', 
          'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts', 'tileview', 'videobackgroundblur', 'mute-everyone', 'security'
        ],
        HIDE_DEEP_LINKING_LOGO: true,
        SHOW_JITSI_WATERMARK: false,
        TILE_VIEW_MAX_COLUMNS: 5,
        DISABLE_POLLING: true,
      },
    };

    api = new JitsiMeetExternalAPI(domain, options);

    // hide the "Start Meeting" button
    document.getElementById('start-button').style.display = 'none';
    // hide the "Start Meeting" button
    document.getElementById('hang-button').style.display = 'block';
    
    const elements = document.querySelectorAll('#msg-card-content');
    for (let i = 0; i < elements.length; i++) {
      elements[i].style.maxWidth = '50%';
    }
  }

  function hangVideoChat() {
    if (api) {
      api.dispose();
      api = null;
    }

    // remove the iframe
    const iframeContainer = document.getElementById('jitsi-iframe-container');
    if (iframeContainer) {
      iframeContainer.innerHTML = '';
    }

    // display the "Start Meeting" button again
    document.getElementById('start-button').style.display = 'block';
    document.getElementById('hang-button').style.display = 'none';
    const elements = document.querySelectorAll('#msg-card-content');
    for (let i = 0; i < elements.length; i++) {
      elements[i].style.maxWidth = '80%';
    }
  }

  const startButton = document.getElementById('start-button');
  startButton.addEventListener('click', startVideoChat);

  const hangButton = document.getElementById('hang-button');
  hangButton.addEventListener('click', hangVideoChat);

  window.addEventListener('beforeunload', hangVideoChat);
</script>




