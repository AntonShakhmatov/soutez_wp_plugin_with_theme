<?php
/*
Template Name: home
*/
?>

<?php get_header(); ?>

	<main>
		<div class="cover">
			<img class="coverPC" src="<?php bloginfo('template_url');?>/assets/images/main/cover.jpg" alt="">
			<img class="coverMobile" src="<?php bloginfo('template_url');?>/assets/images/main/cover-mobile.jpg" alt="">
		</div>

		<div class="background">
			<section id="how-to-win" class="how-to-win">
				<h2>JAK VYHRÁT JEDNU Z CEN</h2>

				<div class="wrapper">
					<div>
						<img src="<?php bloginfo('template_url');?>/assets/images/main/icon-step1.svg" alt="">
						<h3>NAKUP</h3>
						<p>Nakup produkty z Coca-Cola portfolia (Coca-Cola, Coca-Cola Zero, Fanta, Sprite)* za minimální částku 50 Kč v prodejnách Lidl v ČR.</p>
					</div>

					<div>
						<img src="<?php bloginfo('template_url');?>/assets/images/main/icon-step2.svg" alt="">
						<h3>ZAPOJ SE</h3>
						<p>Registruj se přes webový formulář níže nebo odešli <a href="sms:+420123456789">SMS</a>.</p>
					</div>

					<div>
						<img src="<?php bloginfo('template_url');?>/assets/images/main/icon-step3.svg" alt="">
						<h3>HRAJ</h3>
						<p>Uschovej si účtenku, abychom ji při vylosování tvého jména mohli zkontrolovat a předat Ti výhru.</p>
					</div>
				</div>

				<div class="produsts">
					<h4>* Soutěžními produkty jsou:</h4>
					<p>4x 0,33l / 6x 0,33l plech a 0,33l plech, 0,5l / 1l / 1,75l / 2,25l / 2x 1,75l
						4x 1,75l PET Coca-Cola, Coca-Cola Zero, Fanta a Sprite</p>
					<img src="<?php bloginfo('template_url');?>/assets/images/main/products.png" alt="">
					<a class="button" href="#">CHCI VYHRÁT</a>
				</div>
			</section>
		</div>

		
		<section id="rules" class="rules">
			<h2>PRAVIDLA SOUTĚŽE</h2>
			<p class="paragraph">Do soutěže je zařazen vždy pouze <span class="bold">jeden kód</span> z konkrétní účtenky, který obsahuje datum nákupu, prvních 8 znaků BKP a hodnotu nákupu.
				<br><br>
				<span class="bold">Uschovej si všechny pokladní doklady</span>
				(v případě výhry budeme potřebovat nahrát pokladní doklady, které byly registrovány do soutěže pod tvým telefonním číslem.
				Na pokladním dokladu se musí nacházet soutěžní produkty).
				<br><br>
				<span class="bold">Registrace pokladního dokladu</span class="bold"> je možná nejpozději <span class="bold">2 dny po nákupu</span>. V případě nákupu ze dne 17. 6. 2022 musí registrace účtenky proběhnout nejpozději 19. 6. 2022 23:59:59.</p>

				<a class="button" href="#">KOMPLETNÍ PRAVIDLA</a>
		</section>

		<div class="divider"> 
			<img src="<?php bloginfo('template_url');?>/assets/images/main/divider.jpg" alt="">
		</div>

		<div class="backgroundRed">
			<section id="about" class="winnings">
				<h2>VÝHRY</h2>
				<p class="paragraph">V soutěži můžete vyhrát každý den DrumGrill 120l a 200l.</p>

				<div class="wrapper">
					<div class="img">
						<img src="<?php bloginfo('template_url');?>/assets/images/main/winnings.jpg" alt="">
					</div>

					<div class="text">
						<h2><span class="bold">42x</span> DrumGrill</h2>
						<p>V pravidelném každodenním losování vybereme jednoho soutěžícího, který vyhraje DrumGrill 120 l a jednoho, který vyhraje DrumGrill 200l.</p>
						
						<div class="dates">
							<div class="datesWrapper">
								<p>V soutěžním týdnu:</p>
								<ul>
									<?php
									global $wpdb;
									$table_name = $wpdb->prefix . 'aktivny_soutezi';
									$weeks = $wpdb->get_results("SELECT * FROM $table_name");
									foreach($weeks as $week){
										echo $week->zacatek . ' - ' . $week->konec . '<br><br>';
									}
									?>
								</ul>
							</div>

							<div class="datesWrapper">
								<p>Losování probíhá ve dnech:</p>
								<ul>
								<?php
								global $wpdb;
								$table_name = $wpdb->prefix . 'denni_soutezi';
								$days = $wpdb->get_results("SELECT * FROM $table_name");
								foreach($days as $day){
									echo $day->zacatek . ' - ' . $week->konec . '<br><br>';
								}
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="background">
			<section>
				<h2>Soutěž byla ukončena</h2>
				<p class="paragraph">Tato soutěž proběhla v období x. x. 2022 - x. x. 2022.</p>
			</section>
		</div>

		<section class="winners">
			<h2>Výherci</h2>
			<h4>grilů</h4>
			<!-- <p>Výherci denních výher</p> -->

			<ul>
				<?php
					global $wpdb;
					$table_name = $wpdb->prefix . 'prize';
					$prizes = $wpdb->get_results("SELECT * FROM $table_name");
					foreach($prizes as $prize){
						echo "<table style = 'padding-top:3vh; padding-left:10vh;'>";
						echo "<tr>
						<th style = 'padding:1vh;'>Jmeno</th>
						<th style = 'padding:1vh;'>Prijmeni</th>
						<th style = 'padding:1vh;'>Vyhral</th>
						</tr>";

						echo "<tr>";
						echo "<td style = 'padding:2vh;'>" . $prize->jmeno . "</td>";
						echo "<td style = 'padding:2vh;'>" . $prize->prijmeni . "</td>";
						echo "<td style = 'padding:2vh;'>" . $prize->vyhra . "</td>";
						echo "<tr>";
					}
					echo "</table>";
				?>
			</ul>

			<!-- <p>Výherci týdenních výher</p> -->

			<!-- <ul>
				<li>Zdeňka C.</li>
				<li>Petra N.</li>
				<li>Zdeňka C.</li>
				<li>Petra N.</li>
				<li>Zdeňka C.</li>
				<li>Petra N.</li>
				<li>Zdeňka C.</li>
				<li>Petra N.</li>
			</ul> -->
		</section>


		<div class="background">
			<section id="form">
				<h2>ZAPOJ SE DO SOUTĚŽE</h2>
				<p class="paragraph">Už Ti stačí pouze vyplnit krátký formulář nebo poslat SMS s údaji o nákupu, a čekat na losování. Každý den losujeme výherce. Registruj se a jedním z nich můžeš být i ty!</p>
				<form class="form" method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
					<input type="hidden" name="action" value="submit_form_data">
					<div class="formWrapper">
						<div class="form">
							<input type="text" placeholder="Jméno" name="firstname" id="" required="required">
							<input type="text" placeholder="Příjmení" name="surname" id="" required="required">
							<input type="email" placeholder="E-mail" name="email" id="" required="required">
							<input type="tel" placeholder="Telefon" name="phone" id="" required="required">
							<input type="text" placeholder="PSČ" name="psc" id="" required="required"><br><br>
							<label>Datum nákupu<br><input type="date" placeholder="Datum nákupu (dd.mm.yyyy)" name="purchasedate" id="" required="required"></label><br><br>
							<label>Čas nákupu<br><input type="time" placeholder="Čas nákupu" name="bill" id="" required="required"></label>
							<input type="text" placeholder="Cena nákupu" name="price" id="" required="required">

							<div class="checkboxWrapper">
								<label for="consent">Souhlasím se zpracováním osobních údajů</label>
								<input type="checkbox" name="consent" id="consent" required="required">
							</div>

							<div class="checkboxWrapper">
								<label for="interested">Mám zájem o zasílání informací o dalších soutěžích</label>
								<input type="checkbox" name="interested" id="interested">
							</div>
						</div>

						<div class="receipt">
							<img src="<?php bloginfo('template_url');?>/assets/images/main/receipt.png" alt="">
						</div>
					</div>

					<input class="button" type="submit" name="wp-submit" id="wp-submit" value="Odeslat">
				</form>
			</section>
		</div>


		<section>
			<h2>ZAPOJ SE DO SOUTĚŽE POMOCÍ SMS</h2>
			<p class="paragraph">Stačí poslat SMS zprávu na číslo +420 721 068 000 ve tvaru:
				<br><br>
				<span class="bold">LIDL DATUMNAKUPU PRVNICH8ZNAKUBKP HODNOTANAKUPU</span>
				<br><br>
				Datum nákupu uveď v podobě DDMMYYYY. SMS zpráva tedy bude vypadat například takto:
				LIDL 27062022 2BA29566 155.
				<br><br>
				Pokud bude SMS zpráva odeslaná správně, do pěti minut obdržíš potvrzení o registraci do soutěže.
				<br><br>
				Odesláním SMS zprávy souhlasíte se zpracováním osobních údajů dle <span class="bold">pravidel</span>.</p>
		</section>

		<div class="divider">
			<img src="<?php bloginfo('template_url');?>/assets/images/main/divider.jpg" alt="">
		</div>

		<div class="backgroundRed">
			<img src="<?php bloginfo('template_url');?>/assets/images/main/visual.jpg" alt="">

			<section class="logos">
				<div class="wrapper">
					<h4>Zadavatel soutěže</h4>
					<img src="<?php bloginfo('template_url');?>/assets/images/main/logo.svg" alt="">
				</div>

				<div class="wrapper">
					<h4>Pořadatel soutěže</h4>
					<img src="<?php bloginfo('template_url');?>/assets/images/main/creativeheroes.svg" alt="">
				</div>
			</section>
		</div>
	</main>

	<?php get_footer(); ?>
