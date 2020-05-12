@extends('site.layouts.layout-site')

@section("title", "Frequently Asked Questions | Barngate")
@section("description", "Select from the following list of FAQs. Browse through these FAQs to find answers to commonly raised questions.")

@section("content")

	<?php /*?><div class="banner banner-about"></div> <!-- /banner-about --><?php */?>

	<div class="container pt-40 pb-40 text-blue">
		
		<div class="row row-eq-height content-home">

			<div class="col-md-2 col-animal" data-animal="1">
				<a href="{{ route("vistaSearch", "buy-cattle-online") }}">
					<img src="/images/animals/horse-classifieds-barngate-icons-home-vaca.png" />
					<p>Cattle for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="2">
				<a href="{{ route("vistaSearch", "buy-a-horse-online") }}">
					<img src="/images/animals/horse-classifieds-barngate-icons-home-caballo.png" />
					<p>Horse for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="3">
				<a href="{{ route("vistaSearch", "buy-sheep-online") }}">
					<img src="/images/animals/horse-classifieds-barngate-icons-home-oveja.png" />
					<p>Sheep for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="4">
				<a href="{{ route("vistaSearch", "buy-goat-online") }}">
					<img src="/images/animals/horse-classifieds-barngate-icons-home-becerro.png" />
					<p>Goat for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="5">
				<a href="{{ route("vistaSearch", "buy-pig-online") }}">
					<img src="/images/animals/horse-classifieds-barngate-icons-home-cerdo.png" />
					<p>Pig for Sale</p>
				</a>
			</div> <!-- /col-md-2 -->

			<div class="col-md-2 col-animal" data-animal="6">
				<a href="{{ route("vistaSearch", "online-pet-classifleds") }}">
					<img src="/images/animals/horse-classifieds-barngate-icons-home-perro.png" />
					<p>Pet Section</p>
				</a>
			</div> <!-- /col-md-2 -->

		</div> <!-- /row -->
		
		<div class="text-center pt-40 pb-40">
			<h2 class="fw-700 text-center">Frequent Asked Questions</h2>
		</div> <!-- /bg-blue -->
		
		<div class="col-md-12">
			
			<h2 class="fw-700">Purchasing</h2>
				
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">I bought an animal and the animal now has a problem. Doesn’t the seller have to take it back? When do I have a legal claim against the seller?</div>
				<div class="fz-16 bullet-tab">
					<p>As a general matter, animal sales are “buyer beware” transactions.  Most animal sellers, even breeders and brokers, do not have return policies or offer guarantees.</p>
					<p>You only have a legal basis for suing the seller if the seller actively and grossly misrepresented the horse AND you can prove it.  For example, let’s say you purchased a horse for your 10-year-old son and the seller advertised the horse in writing as “bombproof, kid safe, anyone can ride.” You, your trainer and your son tried out the horse, who was quiet as a lamb.  You had the horse vet-checked and he had no physical  problems. Two days later when the horse started bucking like a bronco, you made some inquiries and found out from the seller’s former trainer that the horse bucked off the seller and broke his collarbone in front of 50 witnesses, which is why he was selling the horse.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Is it safe to buy a horse or an animal over the Internet?</div>
				<div class="fz-16 bullet-tab">
					<p>Buying a horse or any animal over the Internet, especially sight unseen, increases the risk that you may be dissatisfied with your purchase.  Photos and videos can be professionally edited to correct conformation flaws and mask gait irregularities.  Behavioral and training issues are not easy to judge from a video, considering that a video is just a snapshot of the horse’s behavior at one moment in time.  Even the horse’s height can be hard to judge with certainty from a photo or video.</p>
					<p>All that being said, the Internet greatly expands your horse-buying choices, and there are things you can do to help protect yourself.  First and foremost, you need to be sure you ask the seller all of the appropriate questions.  Consider hiring a professional trainer specializing in your breed or discipline to go out and evaluate the horse on your behalf.  Next, you should have an independent veterinarian perform a thorough pre-purchase examination on the horse.  If you have any questions about the horse’s conformation or temperament based upon what you have seen, ask the vet to pay attention to those particular points during the exam.  Finally, you should have a written purchase agreement in which the seller makes representations and warranties about the horse’s soundness and behavior.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">How can I get a vet check if the animal I want to buy is far away?</div>
				<div class="fz-16 bullet-tab">
					<p>Use the Internet and/or recommendations from friends, trainers or your own vet to locate a vet in the same vicinity as the animal. If at all possible, use a vet not affiliated with the seller.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">What if the seller is reluctant to sign my purchase agreement?</div>
				<div class="fz-16 bullet-tab">
					<p>Explain why a purchase agreement protects both you and the seller and then answer any questions that the seller may have. If the seller still resists, move on to the next horse – asking the seller to sign a purchase agreement isn’t bad manners, it’s good sense.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">I want to take the animal for a trial period, but the seller doesn’t want the animal to leave his/her property. Should I be suspicious?</div>
				<div class="fz-16 bullet-tab">
					<p>Not necessarily. The seller may have other buyers lined up, or the seller may simply not want to take the risk that something may happen to his/her animal while it is not under her care. If you can, try the animal several times at the seller’s property instead.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Should I take my trainer or riding instructor with me to look at horses?</div>
				<div class="fz-16 bullet-tab">
					<p>Yes! However, even for first-time horse owners, I recommend that you look at horses with an experienced friend first, then take your trainer to see only the horse(s) you are considering buying. This approach will save you money, save your trainer time and you will still be able to benefit from your trainer’s advice and guidance. Before you go out to look at horses, discuss with your trainer what kind of horse you want and ask your trainer what questions you should be asking the seller. When you return, show your trainer any videos or photos you took, and ask him what he thinks of the horse. If he likes the horse, make an appointment with the seller to look at the horse again and bring your trainer along. Be prepared to pay your trainer for his time – to avoid misunderstandings, ask him in advance how much he will charge to accompany you.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<h2 class="mt-40 fw-700">Pricing, ad duration & renewals</h2>
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">How much does it cost to list my animal?</div>
				<div class="fz-16 bullet-tab">
					<p>You can list you animal for free. However we have two plans to give your ad an extra boost. They are the STANDARD and PREMIUM plans.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">What payment methods do you accept?</div>
				<div class="fz-16 bullet-tab">
					<p>We accept all the major credit cards: Visa, American Express, Mastercard and Discover. We do not accept cash, checks, e-checks, Paypal or any other form of payment.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">How long will my ad run for?</div>
				<div class="fz-16 bullet-tab">
					<p>If your plan is FREE, your ad will last 30 days. If your ad is on the STANDARD plan, your ad will last 60 days. If your ad is on the PREMIUM plan, your ad will last 180 days. We will notify you a few days before your ad is due to expire.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Can I renew or upgrade my ad?</div>
				<div class="fz-16 bullet-tab">
					<p>Yes. Both premium and basic ads can be renewed at any point during the ad run. This will bump your listing to the top of search results again. Basic ads may also be upgraded at any time during the ad run. To renew or upgrade, please login to your account, find the ad you would like to renew and click "Renew." If you have recently purchased a basic ad and upgraded to premium, please contact us and we will issue a refund for the original basic ad purchase.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Is there any commission involved with using Barngate.com?</div>
				<div class="fz-16 bullet-tab">
					<p>No. We offer classifieds and are not a brokerage service. There is no commission. We only require a listing fee to place an ad. Nothing else.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<h2 class="mt-40 fw-700">Adding photos or videos into your ad</h2>
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">What are the photo specifications?</div>
				<div class="fz-16 bullet-tab">
					<p>Each photo uploaded must be smaller than 5MB. Files larger than 5MB will not upload, and you will have to shrink the file size. Photos must be in JPG, GIF or TIF format.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">I cannot upload my photos and/or there is no button to upload my photos?</div>
				<div class="fz-16 bullet-tab">
					<p>Make sure your photos are less than 5MB and you are using an updated web browser. If you are still unable to upload your photos, please email them to us, and we will upload them for you.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<!--<div class="item-tab">
				<div class="tab-p fz-18 fw-700">How do I get my video link up?</div>
				<div class="fz-16 bullet-tab">
					<p>Create an account with YouTube or another video service and upload your video there. Go to the YouTube page with your video on it, and copy the link.</p>
					<p>Sign in to your account and go to "My Ads." Select "edit ad" for the horse you are adding the video to. Paste the link and save your ad.</p>
				</div> /bullet-tab 
			</div> /item-tab -->
			
			<h2 class="mt-40 fw-700">Ads management</h2>
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">How do I remove my ad?</div>
				<div class="fz-16 bullet-tab">
					<p>To delete the ad, sign in to your account and click 'delete ad' for the ad(s) you would like removed.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">My animal was sold. How can I mark it as sold?</div>
				<div class="fz-16 bullet-tab">
					<p>To mark the ad as sold, sign in to your account and click on "My Listing." Find the ad you would like to mark as sold, and click "Sold." Your user information will be removed from the ad and you will not be contacted any longer.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<h2 class="mt-40 fw-700">General questions</h2>
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">I am a broker and I run a sale barn, can I list my farm or business as an ad?</div>
				<div class="fz-16 bullet-tab">
					<p>Our listings are designed to for individual animals or in case of some type of animals, per number of heads.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Can I post stud ads, horses wanted, riders wanted, real estate or other types of ads?</div>
				<div class="fz-16 bullet-tab">
					<p>At this time the classifieds are only for animals for sale.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">I want to email a seller. Why do I have to register to contact them?</div>
				<div class="fz-16 bullet-tab">
					<p>All users must be registered so we can protect our buyers and sellers from scams and scammers. You can send a message to the seller through our platform to answer all your questions.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Is the purchase made on the platform?</div>
				<div class="fz-16 bullet-tab">
					<p>No. The purpose of the platform is to exchange information with the buyer and seller and agree to sell outside the platform.</p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
			<div class="item-tab">
				<div class="tab-p fz-18 fw-700">Do you keep my information private?</div>
				<div class="fz-16 bullet-tab">
					<p>Barngate does not and will never sell or give your email address to anyone. Read our <a href="/privacy">Privacy Policy.</a></p>
				</div> <!-- /bullet-tab -->
			</div> <!-- /item-tab -->
			
		</div> <!-- /col-md-12 -->
		
	</div> <!-- /container -->

	@include('site.layouts.form-site')

@endsection