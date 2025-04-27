<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Video Call') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Video Call Session</h3>
                        <div class="space-x-2">
                            <button id="toggleVideo" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                </svg>
                                Camera
                            </button>
                            <button id="toggleAudio" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd" />
                                </svg>
                                Mic
                            </button>
                            <button id="toggleScreen" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                                </svg>
                                Share Screen
                            </button>
                            <button id="endCall" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    <path d="M16.707 3.293a1 1 0 010 1.414L15.414 6l1.293 1.293a1 1 0 01-1.414 1.414L14 7.414l-1.293 1.293a1 1 0 11-1.414-1.414L12.586 6l-1.293-1.293a1 1 0 011.414-1.414L14 4.586l1.293-1.293a1 1 0 011.414 0z" />
                                </svg>
                                End Call
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <div class="video-container bg-gray-900 rounded-lg overflow-hidden shadow-lg">
                                <video id="localVideo" autoplay playsinline muted class="w-full h-full object-cover"></video>
                                <div class="absolute bottom-4 left-4 bg-black bg-opacity-75 text-white px-3 py-1 rounded-md text-sm">
                                    You
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="video-container bg-gray-900 rounded-lg overflow-hidden shadow-lg">
                                <video id="remoteVideo" autoplay playsinline class="w-full h-full object-cover"></video>
                                <div class="absolute bottom-4 left-4 bg-black bg-opacity-75 text-white px-3 py-1 rounded-md text-sm">
                                    Remote User
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .video-container {
            position: relative;
            width: 100%;
            background: #111827;
            border-radius: 0.5rem;
            overflow: hidden;
            aspect-ratio: 16/9;
            min-height: 360px;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #000;
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Button states */
        .disabled {
            background-color: rgb(239 68 68) !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        const mentorshipRequestId = {{ $mentorshipRequestId }};
        const currentUserId = {{ auth()->id() }};
        const otherUserId = {{ $otherUserId }};
        
        let localStream = null;
        let screenStream = null;
        let peerConnection = null;
        let isScreenSharing = false;
        let retryCount = 0;
        const MAX_RETRY_ATTEMPTS = 3;

        // Cleanup function to properly release media devices
        function cleanupMediaDevices() {
            if (localStream) {
                localStream.getTracks().forEach(track => {
                    track.stop();
                    console.log('Stopped track:', track.kind);
                });
                localStream = null;
            }
            if (screenStream) {
                screenStream.getTracks().forEach(track => track.stop());
                screenStream = null;
            }
            if (peerConnection) {
                peerConnection.close();
                peerConnection = null;
            }
        }

        // Update UI elements
        function updateButtonState(buttonId, enabled) {
            const button = document.getElementById(buttonId);
            if (enabled) {
                button.classList.remove('disabled');
            } else {
                button.classList.add('disabled');
            }
        }

        // Show error message
        function showError(message) {
            alert(message);
            console.error(message);
        }

        const configuration = {
            iceServers: [
                { urls: 'stun:stun.l.google.com:19302' },
                { urls: 'stun:stun1.l.google.com:19302' },
                { 
                    urls: 'turn:numb.viagenie.ca',
                    username: 'webrtc@live.com',
                    credential: 'muazkh'
                }
            ]
        };

        // Add this function to check video display
        function checkVideoDisplay(videoElement, streamType) {
            if (videoElement.paused) {
                console.log(`${streamType} video is paused`);
                videoElement.play().catch(e => console.error(`Error playing ${streamType} video:`, e));
            }
            
            if (videoElement.videoWidth === 0 || videoElement.videoHeight === 0) {
                console.log(`${streamType} video dimensions are zero. Width:`, videoElement.videoWidth, 'Height:', videoElement.videoHeight);
            } else {
                console.log(`${streamType} video dimensions - Width:`, videoElement.videoWidth, 'Height:', videoElement.videoHeight);
            }
            
            // Log video element properties
            console.log(`${streamType} video properties:`, {
                readyState: videoElement.readyState,
                paused: videoElement.paused,
                currentTime: videoElement.currentTime,
                srcObject: videoElement.srcObject ? 'Set' : 'Not set',
                style: {
                    width: videoElement.style.width,
                    height: videoElement.style.height,
                    display: window.getComputedStyle(videoElement).display
                }
            });
        }

        async function initializeCall() {
            try {
                console.log('Initializing call...');
                
                // Cleanup any existing streams first
                cleanupMediaDevices();
                
                // Try different video constraints if initial attempt fails
                const videoConstraints = [
                    { // First try: HD with specific device
                        video: {
                            width: { ideal: 1280 },
                            height: { ideal: 720 },
                            facingMode: 'user'
                        },
                        audio: true
                    },
                    { // Second try: Basic constraints
                        video: true,
                        audio: true
                    },
                    { // Third try: VGA resolution
                        video: {
                            width: { exact: 640 },
                            height: { exact: 480 }
                        },
                        audio: true
                    }
                ];

                let error;
                for (const constraints of videoConstraints) {
                    try {
                        console.log('Trying constraints:', constraints);
                        localStream = await navigator.mediaDevices.getUserMedia(constraints);
                        error = null;
                        break;
                    } catch (e) {
                        error = e;
                        console.warn('Failed to get media with constraints:', constraints, 'Error:', e);
                        await new Promise(resolve => setTimeout(resolve, 1000)); // Wait before retry
                    }
                }

                if (error) {
                    throw error; // If all attempts failed, throw the last error
                }
                
                console.log('Got local stream:', localStream.getTracks().map(t => t.kind));
                
                // Set up local video
                const localVideo = document.getElementById('localVideo');
                if (!localVideo) {
                    throw new Error('Local video element not found');
                }
                
                localVideo.srcObject = localStream;
                
                // Add loadedmetadata event listener
                localVideo.addEventListener('loadedmetadata', () => {
                    console.log('Local video metadata loaded');
                    checkVideoDisplay(localVideo, 'Local');
                });

                // Force play attempt after a short delay
                await new Promise(resolve => setTimeout(resolve, 100));
                await localVideo.play().catch(async e => {
                    console.error('Error playing local video:', e);
                    if (retryCount < MAX_RETRY_ATTEMPTS) {
                        retryCount++;
                        console.log(`Retrying video initialization (attempt ${retryCount})`);
                        await initializeCall();
                        return;
                    }
                    showError('Error displaying local video. Please check your camera permissions and ensure no other application is using the camera.');
                });
                
                console.log('Local video playing:', localVideo.srcObject.active);

                // Create and configure peer connection
                peerConnection = new RTCPeerConnection(configuration);
                console.log('Created peer connection');

                // Add all local tracks to the peer connection
                localStream.getTracks().forEach(track => {
                    const sender = peerConnection.addTrack(track, localStream);
                    console.log('Added track to peer connection:', track.kind, sender);
                });

                // Handle incoming tracks
                peerConnection.ontrack = event => {
                    console.log('Received remote track:', event.track.kind);
                    const remoteVideo = document.getElementById('remoteVideo');
                    if (!remoteVideo) {
                        console.error('Remote video element not found');
                        return;
                    }
                    
                    // Ensure old stream is stopped
                    if (remoteVideo.srcObject) {
                        remoteVideo.srcObject.getTracks().forEach(track => track.stop());
                    }
                    
                    remoteVideo.srcObject = event.streams[0];
                    console.log('Set remote stream:', event.streams[0].active);
                    
                    // Add loadedmetadata event listener
                    remoteVideo.addEventListener('loadedmetadata', () => {
                        console.log('Remote video metadata loaded');
                        checkVideoDisplay(remoteVideo, 'Remote');
                    });

                    // Force play attempt after a short delay
                    setTimeout(() => {
                        remoteVideo.play().catch(e => {
                            console.error('Error playing remote video:', e);
                            showError('Error displaying remote video. Please check your browser permissions.');
                        });
                    }, 100);
                };

                // Handle ICE candidates
                peerConnection.onicecandidate = event => {
                    if (event.candidate) {
                        console.log('Sending ICE candidate');
                        sendSignal('candidate', event.candidate);
                    }
                };

                // Monitor ICE connection state
                peerConnection.oniceconnectionstatechange = () => {
                    console.log('ICE connection state:', peerConnection.iceConnectionState);
                    if (peerConnection.iceConnectionState === 'failed') {
                        showError('Connection failed. Please try refreshing the page.');
                    }
                };

                // Monitor connection state
                peerConnection.onconnectionstatechange = () => {
                    console.log('Connection state:', peerConnection.connectionState);
                    if (peerConnection.connectionState === 'failed') {
                        showError('Connection failed. Please try refreshing the page.');
                    }
                };

                // Join the Echo presence channel
                console.log('Joining presence channel:', `video-call.${mentorshipRequestId}`);
                Echo.join(`video-call.${mentorshipRequestId}`)
                    .here(users => {
                        console.log('Users in channel:', users);
                        if (users.length > 1) {
                            console.log('Creating offer as there are multiple users');
                            createOffer();
                        }
                    })
                    .joining(user => {
                        console.log('User joined:', user);
                        // Recreate offer when new user joins
                        createOffer();
                    })
                    .leaving(user => {
                        console.log('User left:', user);
                    })
                    .listen('webrtc.signal', async (e) => {
                        console.log('Received signal:', e.type, 'from:', e.fromUserId);
                        if (e.fromUserId !== currentUserId) {
                            try {
                                if (e.type === 'offer') {
                                    await handleOffer(e.data);
                                } else if (e.type === 'answer') {
                                    await handleAnswer(e.data);
                                } else if (e.type === 'candidate') {
                                    await handleCandidate(e.data);
                                }
                            } catch (error) {
                                console.error('Error handling signal:', error);
                                showError('Error establishing connection. Please try refreshing the page.');
                            }
                        }
                    });

            } catch (error) {
                console.error('Error initializing call:', error);
                showError('Could not access camera and microphone. Please ensure you have granted the necessary permissions.');
            }
        }

        async function createOffer() {
            try {
                console.log('Creating offer');
                const offer = await peerConnection.createOffer();
                await peerConnection.setLocalDescription(offer);
                console.log('Set local description');
                sendSignal('offer', offer);
            } catch (error) {
                console.error('Error creating offer:', error);
                showError('Error creating offer. Please try refreshing the page.');
            }
        }

        async function handleOffer(offer) {
            try {
                console.log('Handling offer');
                await peerConnection.setRemoteDescription(new RTCSessionDescription(offer));
                console.log('Set remote description');
                
                const answer = await peerConnection.createAnswer();
                await peerConnection.setLocalDescription(answer);
                console.log('Created and set local answer');
                
                sendSignal('answer', answer);
            } catch (error) {
                console.error('Error handling offer:', error);
                showError('Error handling offer. Please try refreshing the page.');
            }
        }

        async function handleAnswer(answer) {
            try {
                console.log('Handling answer');
                if (!peerConnection.currentRemoteDescription) {
                    await peerConnection.setRemoteDescription(new RTCSessionDescription(answer));
                    console.log('Set remote description from answer');
                }
            } catch (error) {
                console.error('Error handling answer:', error);
                showError('Error handling answer. Please try refreshing the page.');
            }
        }

        async function handleCandidate(candidate) {
            try {
                console.log('Handling ICE candidate');
                if (candidate && !peerConnection.remoteDescription) {
                    // Store candidates until remote description is set
                    console.log('Storing ICE candidate until remote description is set');
                    return;
                }
                
                if (candidate) {
                    await peerConnection.addIceCandidate(new RTCIceCandidate(candidate));
                    console.log('Added ICE candidate');
                }
            } catch (error) {
                console.error('Error handling ICE candidate:', error);
                // Don't show error to user as this is not critical
                console.warn('Failed to add ICE candidate:', error);
            }
        }

        function sendSignal(type, data) {
            console.log('Sending signal:', type);
            fetch('/video-call/signal', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    type: type,
                    data: data,
                    to_user_id: otherUserId,
                    mentorship_request_id: mentorshipRequestId
                })
            }).catch(error => {
                console.error('Error sending signal:', error);
                showError('Error sending signal. Please check your internet connection.');
            });
        }

        // Media control handlers
        document.getElementById('toggleVideo').addEventListener('click', () => {
            const videoTrack = localStream.getVideoTracks()[0];
            if (videoTrack) {
                videoTrack.enabled = !videoTrack.enabled;
                updateButtonState('toggleVideo', videoTrack.enabled);
            }
        });

        document.getElementById('toggleAudio').addEventListener('click', () => {
            const audioTrack = localStream.getAudioTracks()[0];
            if (audioTrack) {
                audioTrack.enabled = !audioTrack.enabled;
                updateButtonState('toggleAudio', audioTrack.enabled);
            }
        });

        document.getElementById('toggleScreen').addEventListener('click', async () => {
            try {
                if (!isScreenSharing) {
                    screenStream = await navigator.mediaDevices.getDisplayMedia({
                        video: true
                    });
                    
                    const videoTrack = screenStream.getVideoTracks()[0];
                    const sender = peerConnection.getSenders().find(s => s.track.kind === 'video');
                    
                    if (sender) {
                        await sender.replaceTrack(videoTrack);
                    }
                    
                    videoTrack.onended = () => {
                        stopScreenSharing();
                    };
                    
                    isScreenSharing = true;
                    updateButtonState('toggleScreen', true);
                } else {
                    stopScreenSharing();
                }
            } catch (error) {
                console.error('Error toggling screen share:', error);
                showError('Could not start screen sharing. Please try again.');
            }
        });

        function stopScreenSharing() {
            if (screenStream) {
                screenStream.getTracks().forEach(track => track.stop());
                screenStream = null;
                
                const videoTrack = localStream.getVideoTracks()[0];
                const sender = peerConnection.getSenders().find(s => s.track.kind === 'video');
                
                if (sender && videoTrack) {
                    sender.replaceTrack(videoTrack).catch(error => {
                        console.error('Error replacing track:', error);
                    });
                }
            }
            
            isScreenSharing = false;
            updateButtonState('toggleScreen', false);
        }

        // Add cleanup event listeners
        window.addEventListener('beforeunload', cleanupMediaDevices);
        window.addEventListener('pagehide', cleanupMediaDevices);
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                cleanupMediaDevices();
            } else {
                // Reinitialize when page becomes visible again
                initializeCall().catch(error => {
                    console.error('Error reinitializing call:', error);
                });
            }
        });

        document.getElementById('endCall').addEventListener('click', () => {
            cleanupMediaDevices();
            window.location.href = '/dashboard';
        });

        // Initialize call when page loads
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM loaded, initializing call...');
            initializeCall().catch(error => {
                console.error('Error in main initialization:', error);
                showError('Failed to initialize call. Please refresh the page and try again.');
            });
        });
    </script>
    @endpush
</x-app-layout> 