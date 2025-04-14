// Get description function
function getDesc(code) {
  if (code === 'BICY') {
	document.getElementById('info-name').innerText = 'Big Cypress National Preserve';
	document.getElementById('info-content').innerText = "The freshwaters of the Big Cypress Swamp, essential to the health of the neighboring Everglades, support the rich marine estuaries along Florida's southwest coast. Conserving over 729,000 acres of this vast swamp, Big Cypress National Preserve contains a mixture of tropical and temperate plant communities that are home to diverse wildlife, including the Endangered Florida panther.";
	document.getElementById('info-directions').innerText = "Big Cypress National Preserve is located along Tamiami Trail East (US 41) and I-75 in southern Florida. The preserve can be accessed by driving from the cities of Miami and Naples. The preserve's two visitor centers are located along Tamiami Trail East.";
	document.getElementById('info-availability').innerText = "The preserve is open 24 hours a day 365 days a year.  The Oasis Visitor Center and the Nathaniel P. Reed Visitor Center are closed on December 25th. No fee is charged for access to the preserve.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=BICY";
  }
  else if (code === 'BISC') {
	document.getElementById('info-name').innerText = 'Biscayne National Park';
	document.getElementById('info-content').innerText = "Within sight of Miami, yet worlds away, Biscayne protects a rare combination of aquamarine waters, emerald islands, and fish-bejeweled coral reefs. Evidence of 10,000 years of human history is here too; from prehistoric tribes to shipwrecks, and pineapple farmers to presidents. For many, the park is a boating, fishing, and diving destination, while others enjoy a warm breeze and peaceful scenery.";
	document.getElementById('info-directions').innerText = "The Dante Fascell Visitor Center may be reached from the Florida Turnpike by taking Exit 6 (Speedway Boulevard). Turn left from exit ramp and continue south to SW 328th Street (North Canal Drive). Turn left on 328th Street and continue for four miles to the end of the road. The park entrance is on the left just before the entrance to Homestead Bayfront Marina.";
	document.getElementById('info-availability').innerText = "The Visitor Center features a museum, park films, art gallery, and a spectacular view of Biscayne Bay are open 9:00 AM - 5:00 PM everyday. Park waters are open 24 hours a day, all year. Launch your own canoe or kayak from the ramp near the parking area, enjoy a picnic on the lawn, or stroll along the jetty trail from 7:00 AM - 5:30 PM.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=BISC";
  }
  else if (code === 'CANA') {
	document.getElementById('info-name').innerText = 'Canaveral National Seashore';
	document.getElementById('info-content').innerText = "Reflect on the barrier island which is composed of dune, hammock, and lagoon habitat. Explore ancient Timucua shell mounds. Experience the sanctuary that is provided for thousands of species of plants and animals that call Canaveral National Seashore home.";
	document.getElementById('info-directions').innerText = "Canaveral National Seashore is located along Florida's East coast in both Volusia & Brevard counties. To access Apollo Beach - take I-95 to exit 249, then go east until it turns into A1A. Follow A1A south to the park entrance. To access Playalinda Beach - take I-95 to exit 220. Go east through Titusville on Garden Street, continue east and follow the signs.";
	document.getElementById('info-availability').innerText = "Canaveral National Seashore is open 7 days a week. Visitor hours are 6:00 am to 8:00 pm. Last entry into the seashore is at 7:00 pm. Seminole Rest is part of Canaveral National Seashore in Oak Hill, FL. The trail is open is open 7 days a week from sunrise to sunset. Please contact the visitor center at 386 428-3384 for more information.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=CANA";
  }
  else if (code === 'CASA') {
	document.getElementById('info-name').innerText = 'Castillo de San Marcos National Monument';
	document.getElementById('info-content').innerText = "Built by the Spanish in St. Augustine to defend Florida and the Atlantic trade route, Castillo de San Marcos National Monument preserves the oldest masonry fortification in the continental United States and interprets more than 450 years of cultural intersections.";
	document.getElementById('info-directions').innerText = "On State Route A1A overlooking Matanzas Bay in the heart of the historic district of Saint Augustine, the Castillo is approximately a five mile drive from Interstate 95.";
	document.getElementById('info-availability').innerText = "The Castillo de San Marcos is open to the public 7 days per week, except Thanksgiving Day (fourth Thursday in November) and Christmas Day (December 25). A maximum capacity of 100 visitors in the historic fort at any time will be in effect. First admission is at 9:00 a.m. and last admission is at 5:00 p.m. The Castillo closes and visitors must exit at 5:15 p.m. The park grounds are closed from midnight until 5:30 a.m.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=CASA";
  }
  else if (code === 'DESO') {
	document.getElementById('info-name').innerText = 'De Soto National Memorial';
	document.getElementById('info-content').innerText = "In May 1539, Conquistador Hernando de Soto’s army of soldiers, hired mercenaries, craftsmen, and clergy made landfall in Tampa Bay. They were met with fierce resistance of indigenous people protecting their homelands. De Soto’s quest for glory and gold would be a four year, four thousand mile odyssey of intrigue, warfare, disease, and discovery that would form the history of the United States.";
	document.getElementById('info-directions').innerText = "Driving Directions: From I-75 Take exit 220 SR 64/Manatee Ave, Gulf Beaches exit. Travel west on SR 64 for approximately 12 miles to 75th St. W. Turn right onto 75th St. W. travel north approximately 2 miles to the northern terminus 75th St. W. turns into De Soto Memorial Hwy and dead ends into the park.";
	document.getElementById('info-availability').innerText = "De Soto National Memorial is open with a Visitor Contact Tent. The park's Visitor Center remains closed due to Hurricane damage. The park cannot offer restrooms or the park movie at this time. Trails are awaiting rehabilitation and access is limited for those who need mobility assistance.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=DESO";	
  }
  else if (code === 'DRTO') {
	document.getElementById('info-name').innerText = 'Dry Tortugas National Park';
	document.getElementById('info-content').innerText = "Almost 70 miles (113 km) west of Key West lies the remote Dry Tortugas National Park. This 100-square mile park is mostly open water with seven small islands. Accessible only by boat or seaplane, the park is known the world over as the home of magnificent Fort Jefferson, picturesque blue waters, superlative coral reefs and marine life, and the vast assortment of bird life that frequents the area.";
	document.getElementById('info-directions').innerText = "Dry Tortugas National Park is one of the most remote parks in the National Park System. Located approximately 70 miles west of Key West it is accessible only by a daily concession ferry, private boats, charter boats, or seaplane.";
	document.getElementById('info-availability').innerText = "The Dry Tortugas is open 24 hours, 7 days a week. This includes holidays.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=DRTO";
  }
  else if (code === 'EVER') {
	document.getElementById('info-name').innerText = 'Everglades National Park';
	document.getElementById('info-content').innerText = "Everglades National Park protects an unparalleled landscape that provides important habitat for numerous rare and endangered species like the manatee, American crocodile, and the elusive Florida panther. An international treasure as well - a World Heritage Site, International Biosphere Reserve, a Wetland of International Importance, and a specially protected area under the Cartagena Treaty.";
	document.getElementById('info-directions').innerText = "Directions to Ernest Coe Visitor Center 40001 State Road 9336, Homestead, FL 33034 Visitors coming from the Miami area and points north should take the Florida Turnpike (Route 821) south until it ends merging with U.S. 1 at Florida City. Turn right at the first traffic light onto Palm Drive (State Road 9336/SW 344th St.) and follow the signs to the park. Visitors driving north from the Florida Keys should turn left on Palm Drive in Florida City and follow the signs to the park.";
	document.getElementById('info-availability').innerText = "Everglades National Park is open 7 days a week, 24 hours a day. Park entrance is always open but staffed from 8:00 a.m. to 4:30 p.m.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=EVER";
  }
  else if (code === 'FOMA') {
	document.getElementById('info-name').innerText = 'Fort Matanzas National Monument';
	document.getElementById('info-content').innerText = "Fort Matanzas National Monument preserves the fortified coquina watchtower, completed in 1742, which defended the southern approach to the Spanish military settlement of St. Augustine. It also protects approximately 300 acres of Florida coastal environment containing dunes, marsh, maritime forest, and associated flora and fauna, including threatened and endangered species.";
	document.getElementById('info-directions').innerText = "Fort Matanzas is 14 miles south of Saint Augustine on State Route A1A.";
	document.getElementById('info-availability').innerText = "No ferry service to Fort Matanzas on Tuesdays or Wednesdays. The outdoor areas at the Fort Matanzas Visitor Center Area are open from 9 a.m. to 5:30 p.m. Public restrooms, nature trails, fishing access, and basic visitor information and orientation services are available.Fort tours are running Wednesday through Monday with limited capacity. Boarding passes are available on a first come, first served basis. Tours may fill up early in the day. No oversized parking is available.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=FOMA";	
  }
  else if (code === 'GUIS') {
	document.getElementById('info-name').innerText = 'Gulf Islands National Seashore';
	document.getElementById('info-content').innerText = "Millions of visitors are drawn to the Gulf of America for Gulf Islands National Seashore's emerald coast waters, magnificent white beaches, fertile marshes and historical landscapes. Come explore with us today!";
	document.getElementById('info-directions').innerText = "Gulf Islands National Seashore is a place of myriad riches - blue-green, sparkling waters, magnificent white beaches, and fertile coastal marshes. Its 13 areas include historic forts, shaded picnic areas, trails, and campgrounds. From Cat Island, Mississippi, it stretches eastward 160 miles tot he Okaloosa Area east of For Walton Beach, Florida. The Davis Bayou Area is located south of U. S. Hwy. 90 east of downtown Ocean Springs, Mississippi and offers many recreational opportunities.";
	document.getElementById('info-availability').innerText = "Visitors can enjoy fishing, hiking, biking, birdwatching, picnicking, kayaking and ranger-led programs. There are no swimming beaches in the Davis Bayou Area. Visitor Center hours are 9 a.m. to 4 p.m.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=GUIS";
  }
  else if (code === 'TIMU') {
	document.getElementById('info-name').innerText = 'Timucuan Ecological & Historic Preserve';
	document.getElementById('info-content').innerText = "Visit one of the last unspoiled coastal wetlands on the Atlantic Coast. Discover 6,000 years of human history and experience the beauty of salt marshes, coastal dunes, and hardwood hammocks. The Timucuan Preserve includes Fort Caroline and Kingsley Plantation.";
	document.getElementById('info-directions').innerText = "The beautiful expanse of the Timucuan Preserve is located within the city limits of Jacksonville, Florida. The Preserve can be accessed from major roads and highways in and around Jacksonville. Directions to individual park sites such as Kingsley Plantation, American Beach and the Ribault Column can be found on our website. Our main visitor center is located at Fort Caroline, about 14 miles northeast of downtown.";
	document.getElementById('info-availability').innerText = "The grounds for Fort Caroline and Kingsley Plantation are open 9:00 a.m. to 5:00 p.m., Wednesday through Sunday; closed on Thanksgiving, Christmas Day, and New Year's Day. The preserve headquarters is open 7:45 a.m. to 4:15 p.m., Monday through Friday; closed on all government holidays. Cedar Point and the Theodore Roosevelt Area are open sunrise - sunset.";
	document.getElementById('link').href="Trailblaze/park/index.html?parkCode=TIMU";
  }
  else {
	document.getElementById('info-name').innerText = '';
	document.getElementById('info-content').innerText = "";
	document.getElementById('info-directions').innerText = "";
	document.getElementById('info-availability').innerText = "";
	document.getElementById('link').href="";
  }
  if (document.getElementById('bookmarker').value !== null) {
	document.getElementById('bookmarker').value = code;
  }
}

// Open the info window
function openInfo(parkCode) {
  getDesc(parkCode);
  document.getElementById('info-window').style.display = 'block';
  document.getElementById('map-window').style.float = 'right';

}

// Close the info window
function closeInfo() {
  document.getElementById('info-window').style.display = 'none';
  document.getElementById('map-window').style.float = 'none';
}
