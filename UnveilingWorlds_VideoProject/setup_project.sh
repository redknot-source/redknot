#!/bin/bash

# 🎬 UNVEILING WORLDS - Quick Start Setup Script
# This script helps organize your video production project

echo "🌍 Unveiling Worlds - Video Production Setup"
echo "==========================================="
echo ""

# Create additional folder structure for assets
echo "📁 Creating asset folder structure..."

# Create detailed footage subfolders
mkdir -p "Assets/Footage/01_Dubai"
mkdir -p "Assets/Footage/02_Australia"
mkdir -p "Assets/Footage/03_France"
mkdir -p "Assets/Footage/04_Germany"
mkdir -p "Assets/Footage/05_Czech_Republic"
mkdir -p "Assets/Footage/06_Lithuania"
mkdir -p "Assets/Footage/07_Other_Europe"
mkdir -p "Assets/Footage/08_Human_Elements"
mkdir -p "Assets/Footage/09_Backup_Options"

# Create music and audio subfolders
mkdir -p "Assets/Music/01_Main_Track"
mkdir -p "Assets/Music/02_Sound_Design"
mkdir -p "Assets/Music/03_Ambient_Audio"
mkdir -p "Assets/Music/04_Alternative_Versions"

# Create graphics subfolders
mkdir -p "Assets/Graphics/01_Text_Overlays"
mkdir -p "Assets/Graphics/02_Logos_Branding"
mkdir -p "Assets/Graphics/03_Animations"
mkdir -p "Assets/Graphics/04_CTA_Buttons"

# Create final exports folder
mkdir -p "Final_Exports/01_Master_4K"
mkdir -p "Final_Exports/02_Web_HD"
mkdir -p "Final_Exports/03_Mobile"
mkdir -p "Final_Exports/04_Social_Media"

echo "✅ Folder structure created successfully!"
echo ""

# Create footage checklist file
echo "📋 Creating footage acquisition checklist..."

cat > "Assets/Footage/FOOTAGE_CHECKLIST.md" << 'EOF'
# 📹 FOOTAGE ACQUISITION CHECKLIST
## Unveiling Worlds Video Production

---

## 🎯 PRIORITY SHOTS (Must Have)

### Dubai Section
- [ ] Burj Khalifa drone shot at golden hour
- [ ] Desert safari/dune buggy action
- [ ] Traditional souk or cultural scene
- [ ] Dubai fountain or luxury elements

### Australia Section  
- [ ] Sydney Opera House aerial view
- [ ] Beach/surf culture scenes
- [ ] Great Barrier Reef underwater (or alternative nature)
- [ ] Outback/wildlife shots

### European Section
#### France
- [ ] Eiffel Tower night with sparkle lights
- [ ] Parisian café culture scene
- [ ] Seine river or French countryside

#### Germany  
- [ ] Neuschwanstein Castle with landscape
- [ ] Traditional festival or city scenes
- [ ] Alpine or forest landscapes

#### Prague
- [ ] Charles Bridge at dawn/dusk
- [ ] Astronomical clock close-up
- [ ] Prague Old Town architecture

#### Lithuania
- [ ] Trakai Island Castle on lake
- [ ] Vilnius Old Town or nature scenes
- [ ] Baltic coast or forest landscapes

#### Other Europe (Quick shots)
- [ ] Venice gondola in canal
- [ ] Rome Colosseum
- [ ] Santorini sunset with white buildings
- [ ] Swiss Alps mountain vista
- [ ] Amsterdam canal houses
- [ ] Barcelona Sagrada Familia

### Human Elements
- [ ] Diverse group of travelers at scenic viewpoint
- [ ] People genuinely enjoying experiences
- [ ] Multi-generational travel scenes
- [ ] Adventure/exploration moments

---

## 📊 FOOTAGE QUALITY STANDARDS

### Technical Requirements
- [ ] 4K UHD resolution minimum
- [ ] 30fps or higher frame rate
- [ ] Professional stabilization
- [ ] RAW or high-quality color space
- [ ] Commercial licensing included

### Visual Criteria
- [ ] Golden hour lighting preferred
- [ ] Cinematic composition
- [ ] Rich, saturated colors
- [ ] Sharp focus and detail
- [ ] Weather: Clear or dramatically appropriate

---

## 💰 BUDGET TRACKING

### Premium Shots (60% budget): $______
- Iconic landmarks and hero shots
- Professional drone footage
- Exclusive or rare angles

### Standard Shots (30% budget): $______  
- Cultural scenes and lifestyle
- Nature and landscape footage
- Supporting B-roll content

### Backup/Alternative (10% budget): $______
- Weather variations
- Different angles
- Seasonal alternatives

**Total Footage Budget: $______**

---

## 📝 NOTES & ALTERNATIVES

### Backup Options Identified:
- Alternative weather conditions
- Different time of day versions
- Seasonal variations
- Similar locations if primary unavailable

### Custom Footage Opportunities:
- Local videographer contacts
- Tourism board partnerships
- User-generated content licensing
- Commissioned drone work

---

**Completion Status: ___/45 shots acquired**
**Ready for Production: [ ] Yes [ ] No**
EOF

echo "✅ Footage checklist created!"
echo ""

# Create music checklist
echo "🎵 Creating music and audio checklist..."

cat > "Assets/Music/AUDIO_CHECKLIST.md" << 'EOF'
# 🎵 AUDIO ACQUISITION CHECKLIST
## Unveiling Worlds Video Production

---

## 🎼 PRIMARY MUSIC TRACK

### Requirements
- [ ] 45-second duration (minimum)
- [ ] Orchestral/cinematic style
- [ ] Emotional progression: mysterious → adventurous → uplifting
- [ ] No vocals (instrumental only)
- [ ] Commercial license included
- [ ] 48kHz/24-bit quality

### Source Options
- [ ] Artlist.io subscription
- [ ] Epidemic Sound license
- [ ] AudioJungle one-time purchase
- [ ] Custom composer commission
- [ ] Other: ________________

**Selected Track:** ____________________
**License Cost:** $____________________
**Delivery Date:** ____________________

---

## 🔊 SOUND DESIGN ELEMENTS

### Dubai Ambience
- [ ] Desert wind sounds
- [ ] Distant city hum
- [ ] Traditional market atmosphere
- [ ] Luxury/modern sounds

### Australia Ambience  
- [ ] Ocean waves
- [ ] Seagull calls
- [ ] Beach atmosphere
- [ ] Natural outback sounds

### European Ambience
- [ ] Café chatter (Paris)
- [ ] Clock tower chimes (Prague)
- [ ] Festival crowds (Germany)
- [ ] Water sounds (Lithuania)
- [ ] General European city sounds

### Universal Elements
- [ ] Crowd celebration sounds
- [ ] Travel/journey audio (trains, boats)
- [ ] Natural transition sounds
- [ ] Subtle page/book sounds

---

## 📊 AUDIO PRODUCTION SPECS

### Technical Delivery
- [ ] Master mix (full orchestration)
- [ ] Stems separated (strings, brass, percussion)
- [ ] Alternative lengths (30s, 60s versions)
- [ ] Instrumental bed (for voiceover option)
- [ ] WAV format, 48kHz/24-bit

### Mixing Requirements
- [ ] -23 LUFS loudness standard
- [ ] -3dB peak maximum
- [ ] Stereo field optimized
- [ ] Mono compatibility verified
- [ ] Multiple platform testing

---

## 💰 AUDIO BUDGET TRACKING

**Music Track:** $______
**Sound Design:** $______
**Additional Versions:** $______
**Total Audio Budget:** $______

---

## 🎯 CREATIVE NOTES

### Musical Mood Progression:
- 0-5s: Mysterious, building
- 5-20s: Cultural richness, diversity
- 20-35s: Emotional peak, climactic
- 35-45s: Hopeful resolution, inspiring

### Sound Design Philosophy:
- Subtle enhancement, not distraction
- Cultural authenticity where possible
- Seamless integration with music
- Support emotional journey

**Audio Production Status: [ ] Complete [ ] In Progress [ ] Not Started**
EOF

echo "✅ Audio checklist created!"
echo ""

# Create project timeline file
echo "📅 Creating project timeline..."

cat > "PROJECT_TIMELINE.md" << 'EOF'
# 📅 PROJECT TIMELINE
## Unveiling Worlds Video Production

---

## 🗓️ PRODUCTION SCHEDULE

### WEEK 1: PRE-PRODUCTION
**Objective:** Planning, approval, and resource gathering

#### Day 1-2: Concept Review
- [ ] Review interactive prototype with stakeholders
- [ ] Obtain concept approval and feedback
- [ ] Finalize budget allocation
- [ ] Identify and contact production team

#### Day 3-4: Asset Planning
- [ ] Research stock footage sources
- [ ] Create prioritized shot list
- [ ] Research music options
- [ ] Plan technical setup

#### Day 5-7: Team Assembly
- [ ] Hire video editor
- [ ] Engage motion graphics artist (if needed)
- [ ] Secure music/audio resources
- [ ] Set up project files and communication

---

### WEEK 2: ASSET ACQUISITION
**Objective:** Gather all footage, music, and graphics elements

#### Day 8-10: Footage Sourcing
- [ ] Purchase priority stock footage
- [ ] Download and organize all video files
- [ ] Quality check all footage
- [ ] Identify any missing elements

#### Day 11-12: Audio Production
- [ ] Acquire main music track
- [ ] Gather sound design elements
- [ ] Test audio quality and timing
- [ ] Prepare alternative versions if needed

#### Day 13-14: Asset Organization
- [ ] Organize files according to project structure
- [ ] Label and categorize all assets
- [ ] Create backup copies
- [ ] Prepare for editing phase

---

### WEEK 3: PRODUCTION
**Objective:** Video editing, color grading, and audio mixing

#### Day 15-17: Video Editing
- [ ] Set up editing project
- [ ] Rough cut assembly
- [ ] Fine-tune timing and transitions
- [ ] Add basic color correction

#### Day 18-19: Refinement
- [ ] Advanced color grading
- [ ] Audio mixing and synchronization
- [ ] Text overlay creation
- [ ] Visual effects and polish

#### Day 20-21: Review & Revision
- [ ] Internal quality review
- [ ] Client preview and feedback
- [ ] Implement requested changes
- [ ] Prepare for final production

---

### WEEK 4: POST-PRODUCTION & DELIVERY
**Objective:** Final polish, export, and implementation

#### Day 22-24: Final Production
- [ ] Final color grading pass
- [ ] Audio mastering
- [ ] Text animation completion
- [ ] Final quality control review

#### Day 25-26: Export & Testing
- [ ] Export all required formats
- [ ] Cross-platform compatibility testing
- [ ] Mobile optimization verification
- [ ] Performance testing

#### Day 27-28: Delivery & Launch
- [ ] Client final approval
- [ ] Website integration
- [ ] Launch preparation
- [ ] Success metrics setup

---

## ⚠️ CRITICAL MILESTONES

### Week 1 Completion: Project Foundation
**Deliverable:** Approved concept, team assembled, budget allocated

### Week 2 Completion: All Assets Acquired  
**Deliverable:** Complete footage library, music track, organized files

### Week 3 Completion: Rough Cut Complete
**Deliverable:** Functional video with timing, basic color, audio sync

### Week 4 Completion: Final Delivery
**Deliverable:** Polished video in all formats, integrated on website

---

## 🚨 RISK MITIGATION

### Potential Delays & Solutions:
- **Stock footage unavailable:** Pre-identified backup options
- **Music licensing issues:** Multiple source options prepared
- **Technical problems:** Buffer time built into schedule
- **Client revisions:** Limited revision rounds defined upfront

### Quality Assurance Gates:
- Daily progress reviews
- Weekly stakeholder check-ins
- Technical quality standards at each milestone
- Client approval required before proceeding to next phase

---

**Project Start Date:** ___________
**Target Completion:** ___________
**Launch Date:** ___________
EOF

echo "✅ Project timeline created!"
echo ""

# Create a simple contact sheet template
echo "📞 Creating team contact sheet..."

cat > "TEAM_CONTACTS.md" << 'EOF'
# 👥 TEAM CONTACT SHEET
## Unveiling Worlds Video Production

---

## 🎬 CORE PRODUCTION TEAM

### Project Manager
**Name:** ________________________
**Email:** _______________________
**Phone:** _______________________
**Role:** Overall coordination, timeline management

### Video Editor
**Name:** ________________________
**Email:** _______________________
**Phone:** _______________________
**Software:** Premiere Pro / Final Cut / DaVinci Resolve
**Rate:** $______/hour or $______ flat fee

### Motion Graphics Artist
**Name:** ________________________
**Email:** _______________________
**Phone:** _______________________
**Software:** After Effects / Motion
**Rate:** $______/hour or $______ flat fee

### Audio Engineer (if separate)
**Name:** ________________________
**Email:** _______________________
**Phone:** _______________________
**Specialties:** Music production, sound design, mixing

---

## 🎵 MUSIC & AUDIO RESOURCES

### Music Composer/Source
**Name/Service:** ___________________
**Contact:** _______________________
**License Type:** __________________
**Cost:** $_______________________

### Sound Design
**Source:** _______________________
**Contact:** _______________________
**License:** ______________________

---

## 📹 FOOTAGE & GRAPHICS

### Stock Footage Library
**Primary Source:** ________________
**Account Holder:** ________________
**Budget Remaining:** $______________

### Graphics/Brand Assets
**Brand Contact:** __________________
**Logo Files Location:** ____________
**Brand Guidelines:** _______________

---

## 👤 CLIENT & STAKEHOLDERS

### Primary Client Contact
**Name:** ________________________
**Title:** _______________________
**Email:** _______________________
**Phone:** _______________________
**Preferred Communication:** ________

### Final Approval Authority
**Name:** ________________________
**Title:** _______________________
**Email:** _______________________
**Availability:** __________________

### Marketing Team Contact
**Name:** ________________________
**Email:** _______________________
**Role:** Website integration, analytics setup

---

## 🔧 TECHNICAL SUPPORT

### Web Developer
**Name:** ________________________
**Email:** _______________________
**Role:** Video integration, optimization

### IT/Technical Support
**Contact:** ______________________
**For:** File sharing, technical issues

---

## 📅 MEETING SCHEDULE

### Weekly Check-ins
**Day/Time:** ____________________
**Attendees:** ___________________
**Platform:** ____________________

### Milestone Reviews
**Week 1 Review:** ________________
**Week 2 Review:** ________________
**Week 3 Review:** ________________
**Final Approval:** _______________

---

**Emergency Contact:** ____________
**Backup Communication:** _________
EOF

echo "✅ Team contact sheet created!"
echo ""

echo "🎉 Setup Complete!"
echo ""
echo "Next Steps:"
echo "1. Open 'Prototype/interactive_video_prototype.html' to review the concept"
echo "2. Read 'README.md' for complete project overview"
echo "3. Fill out the checklists and contact information"
echo "4. Begin asset acquisition using the production guides"
echo ""
echo "Good luck with your video production! 🌍✨"