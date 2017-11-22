describe('Mega menu vehicles', function() {
	it('Click vehicle should display vehicles', function() {
		cy.visit('https://mmnz-2.dev')

		cy.wait(2000)

		cy.get('.header__navigation').contains('Vehicles').click()
		cy.get('.megamenu__wrapper').should('be.visible')
	})
	it('Vehicle section should contain vehicles', function() {
		cy.get('.megamenu__wrapper').find('li.list__item').should('not.have.length', 0)
	})
	it('All vehicles should have image', function() {
		cy.get('.megamenu__wrapper .list__item')
		.each(function($el, index, $list){
			cy.wrap($el).find('img').should('have.length', 1)
		})
	})
	it('Escape should close mega menu', function() {
		cy.get('body').type('{esc}').then(() => {
			cy.get('.megamenu__wrapper').should('not.be.visible')
		})
	})
})


describe('Mega menu', function() {
	it('Click buyers section should display results', function() {
		cy.visit('https://mmnz-2.dev')

		cy.wait(2000)

		cy.get('.header__navigation').contains('Buyers').click()

		cy.wait(2000)

		cy.get('.megamenu__wrapper').should('be.visible')
	})

	it('Buyers section should contain items', function() {
		cy.get('.megamenu__wrapper').find('li.list__item').should('not.have.length', 0)
	})
})
