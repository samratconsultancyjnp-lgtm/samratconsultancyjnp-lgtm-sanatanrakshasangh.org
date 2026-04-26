@extends('layouts.public')

@section('content')
<section class="about-section">
    <div class="about-grid">
        <div class="about-image-container">
            <div class="about-image-blob"></div>
            <img src="{{ asset('images/about/group.png') }}" alt="About Sanatan Raksha Sangh" class="about-main-img">
        </div>
        <div class="about-content">
            <h4>हमारे बारे में</h4>
            <h2>सनातन रक्षा संघ</h2>
            <p>
                सनातन रक्षा संघ की स्थापना सनातन धर्म की रक्षा और उसके मूल सिद्धांतों को पुनः जागृत करने के उद्देश्य से की गई है। हमारा लक्ष्य केवल प्राचीन संस्कृति और परंपराओं को संरक्षित करना नहीं, बल्कि समाज को उसकी सांस्कृतिक जड़ों से जोड़ना भी है। हम मानते हैं कि एक सच्चे सनातनी की पहचान शस्त्र और शास्त्र - दोनों में संतुलन से होती है। देवी-देवताओं के अस्त्र-शस्त्र सिर्फ प्रतीक नहीं, वे आत्मबल, कर्तव्य और सामर्थ्य का संदेश देते हैं। सनातन रक्षा संघ हर व्यक्ति को आध्यात्मिक, शारीरिक और सांस्कृतिक रूप से सशक्त बनाकर सनातन धर्म के उज्ज्वल प्रकाश को घर-घर तक पहुँचाने का कार्य कर रहा है।
            </p>
            
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-hands-helping"></i></div>
                    <div class="stat-number">500+</div>
                    <div class="stat-label">परिवारों तक पहुँची सेवा</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-dharmachakra"></i></div>
                    <div class="stat-number">160+</div>
                    <div class="stat-label">संपन्न धर्मकार्य</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-om"></i></div>
                    <div class="stat-number">336+</div>
                    <div class="stat-label">सनातनी जुड़ाव</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                    <div class="stat-number">156+</div>
                    <div class="stat-label">सम्मानित प्रयास</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 5rem 10%; background: #fff;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
        <div style="background: var(--bg-light); padding: 3rem; border-radius: 2rem; border: 1px solid rgba(255, 102, 0, 0.1); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 8rem; color: var(--primary); opacity: 0.05;"><i class="fas fa-bullseye"></i></div>
            <div style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 10px 20px rgba(255, 102, 0, 0.2);">
                <i class="fas fa-bullseye"></i>
            </div>
            <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: var(--secondary);">हमारा लक्ष्य (Our Mission)</h3>
            <p style="color: #64748b; line-height: 1.8;">
                हमारा मिशन सनातन धर्म के मूल मूल्यों की रक्षा करना, प्राचीन ज्ञान को आधुनिक समाज के लिए सुलभ बनाना और हर सनातनी को अपनी जड़ों पर गर्व करने के लिए प्रेरित करना है। हम समाज के हर वर्ग को एक सूत्र में पिरोकर एक सशक्त और जागरूक सांस्कृतिक समुदाय का निर्माण करना चाहते हैं।
            </p>
        </div>

        <div style="background: var(--bg-dark); padding: 3rem; border-radius: 2rem; color: white; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; font-size: 8rem; color: var(--primary); opacity: 0.1;"><i class="fas fa-eye"></i></div>
            <div style="width: 60px; height: 60px; background: var(--primary); color: white; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);">
                <i class="fas fa-eye"></i>
            </div>
            <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: var(--primary);">हमारी दृष्टि (Our Vision)</h3>
            <p style="color: rgba(255,255,255,0.8); line-height: 1.8;">
                हमारी दृष्टि एक ऐसे विश्व की है जहाँ सनातन धर्म की उदारता, सहिष्णुता और ज्ञान का प्रकाश हर हृदय को आलोकित करे। हम एक ऐसे समाज की कल्पना करते हैं जहाँ हर व्यक्ति आध्यात्मिक रूप से समृद्ध, शारीरिक रूप से सक्षम और सांस्कृतिक रूप से गौरवान्वित होकर मानवता की सेवा में संलग्न हो।
            </p>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="section-title">
        <h2>संघ की शक्ति – <span>हमारी टीम</span></h2>
        <p>सनातन रक्षा संघ की नींव उन महान व्यक्तियों पर टिकी है, जिन्होंने अपने जीवन का हर क्षण धर्म, सेवा और संस्कृति के उत्थान को समर्पित कर दिया। इनका समर्पण सिर्फ एक संगठन के लिए नहीं, बल्कि संपूर्ण सनातन समाज के लिए है।</p>
    </div>

    <div class="team-grid">
        @forelse($team as $member)
            <div class="team-card">
                <div class="team-img-wrapper">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 3px solid var(--primary); border-radius: 20px; transform: rotate({{ rand(-3, 3) }}deg); z-index: 1; opacity: 0.3;"></div>
                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                </div>
                <div class="team-info">
                    <h3>{{ $member->name }}</h3>
                    <p>{{ $member->designation }}</p>
                </div>
            </div>
        @empty
            <p style="grid-column: span 4; color: #94a3b8;">टीम की जानकारी जल्द ही उपलब्ध होगी।</p>
        @endforelse
    </div>
</section>
@endsection

